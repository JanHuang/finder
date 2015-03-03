<?php
/**
 * Created by PhpStorm.
 * User: janhuang
 * Date: 15/3/3
 * Time: 下午2:32
 * Github: https://www.github.com/janhuang 
 * Coding: https://www.coding.net/janhuang
 * SegmentFault: http://segmentfault.com/u/janhuang
 * Blog: http://segmentfault.com/blog/janhuang
 * Gmail: bboyjanhuang@gmail.com
 */

namespace Dobee\Finder\Annotation;

/**
 * Class Annotation
 *
 * @package Dobee\Finder\Annotation
 */
class Annotation extends \SplFileObject
{
    /**
     * @var string
     */
    private $className;

    /**
     * @var null|string
     */
    private $namespace;

    /**
     * @var array
     */
    private $classes;

    /**
     * @var array
     */
    private $methods;

    /**
     * @var AnnotationBag
     */
    private $parametersBag;

    /**
     * @param      $file
     * @param null $namespace
     * @param null $className
     */
    public function __construct($file, $namespace = null, $className = null)
    {
        parent::__construct($file, 'r');

        if (null === $namespace && null === $this->namespace) {
            $namespace = "";
            while (!$this->eof()) {
                if (false !== ($pos = strpos(($line = $this->fgets()), 'namespace')) && substr($line, 0, 1) !== '#' && substr($line, 0, 2) !== '//') {
                    $namespace = substr($line, 10, -2);
                    break;
                }
            }
        }

        if (null === $className && null === $this->className) {
            $className = pathinfo($this->getFilename(), PATHINFO_FILENAME);
            if (!class_exists(implode('\\', array($namespace, $className)))) {
                include $this->getPathname();
            }
        }

        $this->namespace = $namespace;

        $this->className = ucfirst($className);

        $this->parametersBag = new AnnotationBag(new \ReflectionClass(($namespace == "" ? "" : $namespace . "\\" ) . $className));
    }

    /**
     * @return null|string
     */
    public function getNamespace()
    {
        return $this->namespace;
    }

    /**
     * @return string
     */
    public function getClassName()
    {
        return $this->className;
    }

    /**
     * @return array
     */
    public function getClassAnnotation()
    {
        return $this->parametersBag->getClassNameVariables();
    }

    /**
     * @param null|string $method
     * @return array
     */
    public function getMethodsAnnotation($method = null)
    {
        return $this->parametersBag->getMethodsVariables($method);
    }
}