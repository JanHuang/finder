<?php
/**
 * Created by PhpStorm.
 * User: janhuang
 * Date: 15/3/3
 * Time: 上午11:13
 * Github: https://www.github.com/janhuang 
 * Coding: https://www.coding.net/janhuang
 * SegmentFault: http://segmentfault.com/u/janhuang
 * Blog: http://segmentfault.com/blog/janhuang
 * Gmail: bboyjanhuang@gmail.com
 */

namespace Dobee\Finder\File;

use Dobee\Finder\Annotation\Annotation;
use Dobee\Finder\FinderResource;

class File extends FinderResource implements FileInterface
{
    /**
     * @var Annotation
     */
    private $annotation;

    /**
     * @param string $namespace
     * @param string $className
     * @return Annotation
     */
    public function getAnnotation($namespace = null, $className = null)
    {
        if (null === $this->annotation) {
            $this->annotation = new Annotation(
                $this->getDir() . DIRECTORY_SEPARATOR . $this->getName(),
                $namespace,
                $className
            );
        }

        return $this->annotation;
    }
}