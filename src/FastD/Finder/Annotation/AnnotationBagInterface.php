<?php
/**
 * Created by PhpStorm.
 * User: janhuang
 * Date: 15/3/3
 * Time: 下午4:45
 * Github: https://www.github.com/janhuang 
 * Coding: https://www.coding.net/janhuang
 * SegmentFault: http://segmentfault.com/u/janhuang
 * Blog: http://segmentfault.com/blog/janhuang
 * Gmail: bboyjanhuang@gmail.com
 */

namespace FastD\Finder\Annotation;

/**
 * Interface AnnotationBagInterface
 *
 * @package FastD\Finder\Annotation
 */
interface AnnotationBagInterface
{
    /**
     * @return string
     */
    public function getNamespace();

    /**
     * @return string
     */
    public function getClassName();

    /**
     * @return string
     */
    public function getPath();

    /**
     * @return array
     */
    public function getClassNameVariables();

    /**
     * @param null|string $method
     * @return array
     */
    public function getMethodsVariables($method = null);
}