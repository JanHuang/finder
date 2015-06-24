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

use FastD\Finder\File\File;
use FastD\Finder\Directory\Directory;

/**
 * Class Finder
 *
 * @package FastD\Finder
 */
class Finder
{
    /**
     * @var Directory
     */
    protected $workSpace;

    protected $filter;

    public function touch($name)
    {
        touch($name);
    }

    public function unlink($name)
    {}

    public function mkdir($dir, $mode = 0755, $recursion = true)
    {

    }

    public function rmdir($dir, $recursion = true)
    {
    }

    public function rename($old_name, $new_name)
    {

    }

    public function move($name, $to)
    {}

    public function copy($name, $to)
    {

    }

    public function in($dir)
    {
        if (!is_dir($dir)) {
            throw new FinderException(sprintf('%s is cannot a directory.'));
        }

        if ($this->workSpace) {
            $dir = $this->workSpace->getRealPath() . DIRECTORY_SEPARATOR . $dir;
        }

        $this->workSpace = new Directory($dir);

        return $this;
    }

    /**
     * @return File[]
     */
    public function files()
    {
        if (null !== $this->filter && is_callable($this->filter)) {
            $filter = $this->filter;
            return $filter($this->workSpace->files());
        }

        return $this->workSpace->files();
    }

    public function directories()
    {
        return $this->workSpace->directories();
    }

    public function date(\DateTime $dateTime)
    {
        $this->filter = function (array $files) use ($dateTime) {
            foreach ($files as $file) {

            }
        };

        return $this;
    }

    public function name($name)
    {
        $this->filter = function (array $files) use ($name) {};

        return $this;
    }

    public function size($size)
    {
        $this->filter = function (array $files) use ($size) {};

        return $this;
    }
}