<?php
/**
 * Created by PhpStorm.
 * User: janhuang
 * Date: 15/2/17
 * Time: 下午8:57
 * Github: https://www.github.com/janhuang 
 * Coding: https://www.coding.net/janhuang
 * SegmentFault: http://segmentfault.com/u/janhuang
 * Blog: http://segmentfault.com/blog/janhuang
 * Gmail: bboyjanhuang@gmail.com
 */
echo '<pre>';
$loader = include __DIR__ . '/../vendor/autoload.php';

use Dobee\Finder\Finder;

$finder = new Finder();

$files = $finder->in(__DIR__ . '/demo')->files();

foreach ($files as $file) {
    print_r($file->getAnnotation()->getMethods('demoAction'));
}
