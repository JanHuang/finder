<?php
/**
 * Created by PhpStorm.
 * User: janhuang
 * Date: 15/2/17
 * Time: 下午9:01
 * Github: https://www.github.com/janhuang 
 * Coding: https://www.coding.net/janhuang
 * SegmentFault: http://segmentfault.com/u/janhuang
 * Blog: http://segmentfault.com/blog/janhuang
 * Gmail: bboyjanhuang@gmail.com
 */

namespace FastD\Finder\Directory;

/**
 * Class Directory
 *
 * @package FastD\Finder\Directory
 */
use FastD\Finder\File\File;

/**
 * Class Directory
 *
 * @package FastD\Finder\Directory
 */
class Directory extends \RecursiveDirectoryIterator
{
    protected $files;

    protected $directories;

    protected function filterFilesType()
    {
        foreach ($this as $file) {
            if (in_array($file->getFilename(), ['.', '..'])) {
                continue;
            }
            if ($this->isDir()) {
                $this->directories[] = $file;
            }

            if ($file->isFile()) {
                $this->files[] = $file;
            }
        }
    }

    /**
     * @return File[]
     */
    public function files()
    {
        if (null === $this->files) {
            $this->filterFilesType();
        }

        return $this->files;
    }

    public function directories()
    {
        if (null === $this->directories) {
            $this->filterFilesType();
        }

        return $this->directories;
    }
}