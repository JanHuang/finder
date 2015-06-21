<?php
/**
 * Created by PhpStorm.
 * User: janhuang
 * Date: 15/6/15
 * Time: 上午10:32
 * Github: https://www.github.com/janhuang
 * Coding: https://www.coding.net/janhuang
 * SegmentFault: http://segmentfault.com/u/janhuang
 * Blog: http://segmentfault.com/blog/janhuang
 * Gmail: bboyjanhuang@gmail.com
 * WebSite: http://www.janhuang.me
 */


namespace FastD\Finder\Tests;

use FastD\Finder\Finder;

/**
 * Class DirectoryTest
 *
 * @package FastD\Finder\Tests
 */
class DirectoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Finder
     */
    private $finder;

    public function setUp()
    {
        $this->finder = new Finder(__DIR__);
    }

    public function testDirectoryFilesCount()
    {
        foreach ($this->finder as $file) {
            print_r($file);
        }
    }

    public function testDirectoryRoot()
    {

    }
}