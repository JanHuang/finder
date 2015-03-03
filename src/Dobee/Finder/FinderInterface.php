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

namespace Dobee\Finder;

interface FinderInterface
{
    public function setName($name);

    public function getName();

    public function setType($type);

    public function getType();

    public function setSize($size);

    public function getSize();

    public function setDir($dir);

    public function getDir();
}