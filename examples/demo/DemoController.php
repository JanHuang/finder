<?php

namespace Demo;

/**
 * @Route("/")
 * @Demo()
 */
class DemoController
{
    /**
     * @Route("name"="janhuang")
     * @Route("age"="18")
     */
    public function demoAction()
    {}
}