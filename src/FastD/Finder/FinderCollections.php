<?php
/**
 * Created by PhpStorm.
 * User: janhuang
 * Date: 15/3/3
 * Time: 下午12:07
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
 * Class FinderCollections
 *
 * @package FastD\Finder
 */
class FinderCollections extends \RecursiveDirectoryIterator
{
    /**
     * @var array
     */
    private $collections = array();

    /**
     * @var array|File
     */
    private $files;

    /**
     * @var array|Directory
     */
    private $directories;

    /**
     * @param FinderInterface $file
     * @return $this
     */
    public function setFile(FinderInterface $file)
    {
        $this->collections[] = $file;

        switch ($file->getType()) {
            case 'dir':
                $this->directories[$file->getName()] = $file;
                break;
            default:
                $this->files[$file->getName()] = $file;
        }

        return $this;
    }

    /**
     * @return array|File
     */
    public function files()
    {
        return $this->files;
    }

    /**
     * @return array|Directory
     */
    public function directories()
    {
        return $this->directories;
    }

    /**
     * @param $keyword
     */
    public function grep($keyword)
    {}

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Return the current element
     *
     * @link http://php.net/manual/en/iterator.current.php
     * @return FinderInterface Can return any type.
     */
    public function current()
    {
        return current($this->collections);
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
        next($this->collections);
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Return the key of the current element
     *
     * @link http://php.net/manual/en/iterator.key.php
     * @return mixed scalar on success, or null on failure.
     */
    public function key()
    {
        return key($this->collections);
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
        return false !== $this->current();
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
        reset($this->collections);
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
        return count($this->collections);
    }
}