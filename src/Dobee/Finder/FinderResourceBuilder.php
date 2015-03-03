<?php
/**
 * Created by PhpStorm.
 * User: janhuang
 * Date: 15/3/3
 * Time: 上午11:38
 * Github: https://www.github.com/janhuang 
 * Coding: https://www.coding.net/janhuang
 * SegmentFault: http://segmentfault.com/u/janhuang
 * Blog: http://segmentfault.com/blog/janhuang
 * Gmail: bboyjanhuang@gmail.com
 */

namespace Dobee\Finder;

/**
 * Class FinderBuilder
 *
 * @package Dobee\Finder
 */
class FinderResourceBuilder
{
    /**
     * @var array
     */
    private static $types = array(
        'file'  => 'Dobee\\Finder\\File\\File',
        'dir'   => 'Dobee\\Finder\\Directory\\Directory',
    );

    /**
     * @param      $file
     * @return FinderInterface
     * @throws FinderException
     */
    public static function createFinder($file)
    {
        $type = filetype($file);
        if (!isset(static::$types[$type])) {
            throw new FinderException(sprintf('Finder type "%s" is not found.', $type));
        }

        return new static::$types[$type]($file);
    }
}