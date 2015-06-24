<?php
/**
 * Created by PhpStorm.
 * User: janhuang
 * Date: 15/6/24
 * Time: 下午10:08
 * Github: https://www.github.com/janhuang
 * Coding: https://www.coding.net/janhuang
 * SegmentFault: http://segmentfault.com/u/janhuang
 * Blog: http://segmentfault.com/blog/janhuang
 * Gmail: bboyjanhuang@gmail.com
 * WebSite: http://www.janhuang.me
 */

namespace FastD\Finder\Tests;

use FastD\Finder\Finder;

class FinderTest extends \PHPUnit_Framework_TestCase
{
    public function testFinder()
    {
        $finder = new Finder();

        $files = $finder->in(__DIR__)->files();
    }
}
