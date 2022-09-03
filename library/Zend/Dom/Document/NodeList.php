<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Zend\Dom\Document;

use ArrayAccess;
use Countable;
use DOMNode;
use DOMNodeList;
use Iterator;
use Zend\Dom\Exception;

/**
 * DOMNodeList wrapper for Zend\Dom\Document\Query results
 */
class NodeList implements Iterator, Countable, ArrayAccess
{
    /**
     * @var DOMNodeList
     */
    protected $list;

    /**
     * Current iterator position
     * @var int
     */
    protected $position = 0;

    /**
     * Constructor
     *
     * @param DOMNodeList  $list
     */
    public function __construct(DOMNodeList $list)
    {
        $this->list = $list;
    }

    /**
     * Iterator: rewind to first element
     *
     * @return void
     */
    public function rewind() : void
    {
        $this->position = 0;
        $this->list->item(0);
        //return $this->list->item(0);//PHP8
    }

    /**
     * Iterator: is current position valid?
     *
     * @return bool
     */
    public function valid() : bool
    {
        if (in_array($this->position, range(0, $this->list->length - 1)) && $this->list->length > 0) {
            return true;
        }

        return false;
    }

    /**
     * Iterator: return current element
     *
     * @return mixed
     */
    public function current() : mixed
    {
        return $this->list->item($this->position);
    }

    /**
     * Iterator: return key of current element
     *
     * @return mixed
     */
    public function key() : mixed
    {
        return $this->position;
    }

    /**
     * Iterator: move to next element
     * @return void
     */
    public function next() : void
    {
        ++$this->position;
        $this->list->item($this->position);
        //return $this->list->item($this->position);PHP8
    }

    /**
     * Countable: get count
     *
     * @return int
     */
    public function count() : int
    {
        return $this->list->length;
    }

    /**
     * ArrayAccess: offset exists
     *
     * @param int $key
     * @return bool
     */
    public function offsetExists($key) : bool
    {
        if (in_array($key, range(0, $this->list->length - 1)) && $this->list->length > 0) {
            return true;
        }
        return false;
    }

    /**
     * ArrayAccess: get offset
     *
     * @param int $key
     * @return mixed
     */
    public function offsetGet($key) : mixed
    {
        return $this->list->item($key);
    }

    /**
     * ArrayAccess: set offset
     *
     * @param  mixed $key
     * @param  mixed $value
     * @throws Exception\BadMethodCallException when attempting to write to a read-only item
     */
    public function offsetSet($key, $value) : void
    {
        throw new Exception\BadMethodCallException('Attempting to write to a read-only list');
    }

    /**
     * ArrayAccess: unset offset
     *
     * @param  mixed $key
     * @throws Exception\BadMethodCallException when attempting to unset a read-only item
     */
    public function offsetUnset($key) : void
    {
        throw new Exception\BadMethodCallException('Attempting to unset on a read-only list');
    }
}
