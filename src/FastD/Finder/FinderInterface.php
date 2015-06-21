<?php
/**
 * Created by PhpStorm.
 * User: janhuang
 * Date: 15/2/17
 * Time: 下午8:59
 * Github: https://www.github.com/janhuang 
 * Coding: https://www.coding.net/janhuang
 * SegmentFault: http://segmentfault.com/u/janhuang
 * Blog: http://segmentfault.com/blog/janhuang
 * Gmail: bboyjanhuang@gmail.com
 */

namespace FastD\Finder;

/**
 * Interface FinderInterface
 *
 * @package FastD\Finder
 */
interface FinderInterface
{
    /**
     * @param $name
     * @return $this
     */
    public function setName($name);

    /**
     * @return string
     */
    public function getName();

    /**
     * @param $type
     * @return $this
     */
    public function setType($type);

    /**
     * @return string
     */
    public function getType();

    /**
     * @param $size
     * @return $this
     */
    public function setSize($size);

    /**
     * @return int
     */
    public function getSize();

    /**
     * @param $dir
     * @return $this
     */
    public function setDir($dir);

    /**
     * @return string
     */
    public function getDir();
}