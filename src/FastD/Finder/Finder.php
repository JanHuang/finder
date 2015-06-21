<?php
/**
 * Created by PhpStorm.
 * User: janhuang
 * Date: 15/2/17
 * Time: 下午8:40
 * Github: https://www.github.com/janhuang 
 * Coding: https://www.coding.net/janhuang
 * SegmentFault: http://segmentfault.com/u/janhuang
 * Blog: http://segmentfault.com/blog/janhuang
 * Gmail: bboyjanhuang@gmail.com
 */

namespace FastD\Finder;

/**
 * Class Finder
 *
 * @package FastD\Finder
 */
class Finder
{
    /**
     * @var array
     */
    private $regex = [];

    /**
     * @param $name
     * @param int $flag
     * @return Finder
     */
    public function in($name, $flag = \FilesystemIterator::KEY_AS_PATHNAME)
    {
        return new Finder($name, $flag);
    }

    /**
     * @param $name
     * @return $this
     */
    public function name($name)
    {
        $this->regex[] = sprintf('(%s)', $name);

        return $this;
    }

    /**
     * @param $size
     * @return $this
     */
    public function size($size)
    {
        $this->regex[] = sprintf('(%s)', $size);

        return $this;
    }

    /**
     * @param $date
     * @return $this
     */
    public function date($date)
    {
        return $this;
    }

    /**
     * @return array
     */
    public function directories()
    {

    }

    /**
     * @return array
     */
    public function files()
    {
        foreach ($this as $name => $file) {

        }

        return $this;
    }
}