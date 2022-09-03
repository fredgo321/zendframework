<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Zend\Stdlib;

use Serializable;

/**
 * Serializable version of SplQueue
 */
class SplQueue extends \SplQueue
{
    /**
     * Return an array representing the queue
     *
     * @return array
     */
    public function toArray()
    {
        $array = array();
        foreach ($this as $item) {
            $array[] = $item;
        }
        return $array;
    }


    /**
     * @return array
     */
    public function __serialize() : array
    {
        return $this->toArray();
    }

    /**
     * @param $data
     * @return void
     */
    public function __unserialize($data) : void
    {
        foreach ($data as $item) {
            $this->push($item);
        }
    }
}
