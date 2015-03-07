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

namespace Dobee\Finder;

use Dobee\Finder\File\File;
use Dobee\Finder\Directory\Directory;

/**
 * Class Finder
 *
 * @package Dobee\Finder
 */
class Finder implements \Iterator, \Countable
{
    /**
     * @var FinderCollections
     */
    private $collections;

    /**
     * @var array
     */
    private $filter = array();

    /**
     * @var string
     */
    private static $dir;

    /**
     * The finder work directory path.
     *
     * @var string
     */
    private $pwd = "./";

    /**
     * Analog the UNIX grep filter.
     *
     * @param $name
     * @return $this
     */
    public function name($name)
    {
        if (!empty($name)) {
            $this->filter['name'] = function ($fileName) use ($name) {

                $length = strlen(trim($name, '%'));

                $first = substr($name, 0, 1);

                $last = substr($name, -1);

                if ('%' === $first && '%' !==  $last) {
                    return trim($name, '%') === substr($fileName, 0, $length);
                }

                if ('%' === $last && '%' !== $first) {
                    return trim($name, '%') === substr($fileName, -$length);
                }

                if ('%' === $first && '%' === $last) {
                    return false !== strpos($fileName, trim($name, '%'));
                }

                return trim($name, '%') === $fileName;
            };
        }

        return $this;
    }

    /**
     * @param $directory
     * @return $this
     * @throws FinderException
     */
    public function in($directory)
    {
        if (!is_dir($directory)) {
            throw new FinderException(sprintf('Not a directory: %s', $directory));
        }

        $this->pwd = realpath($directory);

        return $this;
    }

    /**
     * @param string $directory
     * @return FinderCollections
     */
    public function scanDirectory($directory)
    {
        $this->collections = new FinderCollections();

        $handler = dir($directory);

        while (false !== ($entry = $handler->read())) {
            if (in_array($entry, array('.', '..'))) { continue; }

            if (isset($this->filter['name']) && is_callable($this->filter['name'])) {
                if (!$this->filter['name'](pathinfo($entry, PATHINFO_FILENAME))) { continue; }
            }

            $finder = FinderResourceBuilder::createFinder($handler->path . DIRECTORY_SEPARATOR . $entry);
            $finder->setDir($handler->path)
                ->setName($entry)
                ->setSize(filesize($handler->path . DIRECTORY_SEPARATOR . $entry))
                ->setType(filetype($handler->path . DIRECTORY_SEPARATOR . $entry))
            ;
            $this->collections->setFile($finder);
        }

        $handler->close();

        return $this->collections;
    }

    /**
     * @return FinderCollections
     */
    public function all()
    {
        if (self::$dir !== $this->pwd) {
            $this->scanDirectory($this->pwd);
        }

        return $this->collections;
    }

    /**
     * @return array|File[]
     */
    public function files()
    {
        return $this->all()->files();
    }

    /**
     * @return array|Directory[]
     */
    public function directories()
    {
        return $this->all()->directories();
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Return the current element
     *
     * @link http://php.net/manual/en/iterator.current.php
     * @return FinderInterface Can return any type.
     */
    public function current()
    {
        return $this->collections->current();
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Move forward to next element
     *
     * @link http://php.net/manual/en/iterator.next.php
     * @return void Any returned value is ignored.
     */
    public function next()
    {
        $this->collections->next();
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Return the key of the current element
     *
     * @link http://php.net/manual/en/iterator.key.php
     * @return string|int scalar on success, or null on failure.
     */
    public function key()
    {
        return $this->collections->key();
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Checks if current position is valid
     *
     * @link http://php.net/manual/en/iterator.valid.php
     * @return boolean The return value will be casted to boolean and then evaluated.
     *       Returns true on success or false on failure.
     */
    public function valid()
    {
        return $this->collections->valid();
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Rewind the Iterator to the first element
     *
     * @link http://php.net/manual/en/iterator.rewind.php
     * @return void Any returned value is ignored.
     */
    public function rewind()
    {
        $this->collections->rewind();
    }

    /**
     * (PHP 5 &gt;= 5.1.0)<br/>
     * Count elements of an object
     *
     * @link http://php.net/manual/en/countable.count.php
     * @return int The custom count as an integer.
     *       </p>
     *       <p>
     *       The return value is cast to an integer.
     */
    public function count()
    {
        return $this->collections->count();
    }
}