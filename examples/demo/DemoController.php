<?php

namespace Demo;

use Dobee\Finder\Annotation\Annotation;

/**
 * @Route("/", name="janhuang", defaults={"name":"janhuang"}, methods=["GET", "POST"])
 * @Route(age="18")
 * @Demo(name="jan")
 */
class DemoController
{
    /**
     * @Route(name=janhuang, defaults={"name":"janhuang"})
     * @Route(age="18")
     */
    public function demoAction(Annotation $annotation, $a)
    {}
}