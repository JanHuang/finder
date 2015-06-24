<?php
/**
 * Created by PhpStorm.
 * User: janhuang
 * Date: 15/6/15
 * Time: 上午10:59
 * Github: https://www.github.com/janhuang
 * Coding: https://www.coding.net/janhuang
 * SegmentFault: http://segmentfault.com/u/janhuang
 * Blog: http://segmentfault.com/blog/janhuang
 * Gmail: bboyjanhuang@gmail.com
 * WebSite: http://www.janhuang.me
 */

namespace FastD\Finder\Tests;

use FastD\Finder\File\File;

class FileTest extends \PHPUnit_Framework_TestCase
{
    public function testFileCount()
    {
        $file = new File(__DIR__ . '/Directory/demo.log');

        $this->assertEquals(__DIR__ . '/Directory', $file->getPath());
    }
}