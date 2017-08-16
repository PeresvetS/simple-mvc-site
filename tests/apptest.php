<?php

require(__DIR__ . "/../simpleengine/core/autoload.php");
require(__DIR__ . "/../vendor/autoload.php");


class AppTest extends \PHPUnit\Framework\TestCase{
    protected $app;

    protected function setUp()
    {
        $configuration = [];
        require(__DIR__ . "/../configuration/main.config.php");

        $this->app = simpleengine\core\Application::instance();
        $this->app->setConfiguration($configuration);
    }

    protected function tearDown()
    {
       $this->app = null;
    }

    public function testSecure()
    {
        $this->assertEquals("&lt;script", $this->app->secure()->
        getSecureQuery("<script>alert('hacked!')</script>", 10));
    }

}



