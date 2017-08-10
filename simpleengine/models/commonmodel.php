<?php

namespace simpleengine\models;

use \simpleengine\core\Application;

class CommonModel 
{
    public $app;
    public $db;
    public $secure;

    public function __construct()
    {
        $this->app = Application::instance();
        $this->db = $this->app->db();
        $this->secure = $this->app->secure();
    }
}