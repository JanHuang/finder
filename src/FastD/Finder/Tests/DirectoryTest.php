<?php
/**
 * Created by PhpStorm.
 * User: janhuang
 * Date: 15/6/24
 * Time: 下午9:47
 * Github: https://www.github.com/janhuang
 * Coding: https://www.coding.net/janhuang
 * SegmentFault: http://segmentfault.com/u/janhuang
 * Blog: http://segmentfault.com/blog/janhuang
 * Gmail: bboyjanhuang@gmail.com
 * WebSite: http://www.janhuang.me
 */

namespace FastD\Finder\Tests;

use FastD\Finder\Directory\Directory;

class DirectoryTest extends \PHPUnit_Framework_TestCase
{
    public function testLs()
    {
        $directory = new Directory(__DIR__ . '/Directory');
    }
}