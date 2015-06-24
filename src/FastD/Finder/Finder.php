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

    const LT = '<';

    const GT = '>';

    const ET = '=';

    const EGT = '>=';

    const ELT = '<=';

    const NET = '!=';

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
        if (null !== $this->filter && is_callable($this->filter)) {
            $filter = $this->filter;
            return $filter($this->workSpace->directories());
        }

        return $this->workSpace->directories();
    }

    public function date(\DateTime $dateTime, $compare = Finder::EGT)
    {
        $this->filter = function (array $files) use ($dateTime, $compare) {
            $afterFiles = [];
            foreach ($files as $file) {
                switch ($compare) {
                    case Finder::GT:
                        if ($this->getMTime() < $dateTime->getTimestamp()) {
                            continue;
                        }
                        break;
                    case Finder::ET:
                        if ($this->getMTime() != $dateTime->getTimestamp()) {
                            continue;
                        }
                        break;
                    case Finder::LT:
                        if ($this->getMTime() > $dateTime->getTimestamp()) {
                            continue;
                        }
                        break;
                    case Finder::ELT:
                        if ($this->getMTime() >= $dateTime->getTimestamp()) {
                            continue;
                        }
                        break;
                    case Finder::NET:
                        if ($this->getMTime() == $dateTime->getTimestamp()) {
                            continue;
                        }
                        break;
                    case Finder::EGT:
                    default:
                        if ($this->getMTime() <= $dateTime->getTimestamp()) {
                            continue;
                        }
                }
                $afterFiles[] = $file;
            }
            return $afterFiles;
        };

        return $this;
    }

    public function name($name)
    {
        $this->filter = function (array $files) use ($name) {
            $afterFiles = [];
            foreach ($files as $file) {
                if (false !== strpos($file->getFilename(), $name)) {
                    $afterFiles[] = $file;
                }
            }
            return $afterFiles;
        };

        return $this;
    }

    public function size($size, $compare = Finder::EGT)
    {
        $this->filter = function (array $files) use ($size, $compare) {
            $afterFiles = [];
            foreach ($files as $file) {
                switch ($compare) {
                    case Finder::GT:
                        if ($this->getSize() < $size) {
                            continue;
                        }
                        break;
                    case Finder::ET:
                        if ($this->getSize() != $size) {
                            continue;
                        }
                        break;
                    case Finder::LT:
                        if ($this->getSize() > $size) {
                            continue;
                        }
                        break;
                    case Finder::ELT:
                        if ($this->getSize() >= $size) {
                            continue;
                        }
                        break;
                    case Finder::NET:
                        if ($this->getSize() == $size) {
                            continue;
                        }
                        break;
                    case Finder::EGT:
                    default:
                    if ($this->getSize() <= $size) {
                        continue;
                    }
                }
                $afterFiles[] = $file;
            }
            return $afterFiles;
        };

        return $this;
    }
}