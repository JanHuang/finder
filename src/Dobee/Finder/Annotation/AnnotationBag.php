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

namespace Dobee\Finder\Annotation;

/**
 * Class AnnotationBag
 *
 * @package Dobee\Finder\Annotation
 */
class AnnotationBag implements AnnotationBagInterface, AnnotationParserInterface
{
    /**
     * @var \ReflectionClass
     */
    private $reflectionClass;

    /**
     * @var array
     */
    private $class = array();

    /**
     * @var array
     */
    private $methods = array();

    /**
     * @param \ReflectionClass $reflectionClass
     */
    public function __construct(\ReflectionClass $reflectionClass)
    {
        $this->reflectionClass = $reflectionClass;

        $this->extractAnnotationVariables($reflectionClass);
    }

    /**
     * @return string
     */
    public function getNamespace()
    {
        return $this->reflectionClass->getNamespaceName();
    }

    /**
     * @return string
     */
    public function getClassName()
    {
        return $this->reflectionClass->getShortName();
    }

    /**
     * @return string
     */
    public function getPath()
    {
        return $this->reflectionClass->getFileName();
    }

    /**
     * @return array
     */
    public function getClassNameVariables()
    {
        return $this->class;
    }

    /**
     * @param null|string $method
     * @return array
     */
    public function getMethodsVariables($method = null)
    {
        if (null === $method) {
            return $this->methods;
        }

        return $this->methods[$method];
    }

    /**
     * @param \ReflectionClass $reflectionClass
     * @return array
     */
    public function extractAnnotationVariables(\ReflectionClass $reflectionClass)
    {
        $parser = function ($annotation, $mapped = array()) {

            $variables = array();

            $definedClass = array();

            if (preg_match_all('/\@([A-Z]\w+)\((.*?)\)/', str_replace(array("\r\n", "\n", '*'), '', $annotation), $matches)) {

                foreach ($matches[1] as $key => $value) {
                    if (!isset($definedClass[$value]['annotation'])) {
                        $definedClass[$value]['annotation'] = array();
                    }

                    $definedClass[$value]['annotation'][] = $matches[2][$key];
                }

                foreach ($definedClass as $class => $annotation) {

                    $annotation = explode(PHP_EOL, preg_replace('/\,\s*(\w+)/', PHP_EOL . '$1', trim(implode(',', $annotation['annotation']))));

                    foreach ($annotation as $key => $val) {
                        $value = $val;
                        if (false !== ($pos = strpos($val, '='))) {
                            list($key, $value) = explode("=", $val);
                        }
                        $value = str_replace('\\', '\\\\', trim($value, '"'));
                        $value = ($json = json_decode($value, true)) ? $json : $value;
                        $variables[$key] = $value;
                    }

                    $definedClass[$class]['parameters'] = $variables;
                    $variables = array();
                }
            }

            return $definedClass;
        };

        $this->class = $parser($reflectionClass->getDocComment(), array(
            'class'     => $reflectionClass->getName(),
            'method'    => null
        ));

        foreach ($reflectionClass->getMethods() as $method) {
            $this->methods[$method->getName()] = $parser($method->getDocComment(), array(
                'class'             => $reflectionClass->getName(),
                'method'            => $method->getName(),
                'parameters'        => $method->getParameters(),
                'parameters_num'    => $method->getNumberOfParameters(),
            ));
        }

        return $this;
    }
}
