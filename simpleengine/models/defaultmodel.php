<?php


namespace simpleengine\models;

use \simpleengine\core\Application;

class DefaultModel
{
    public function testMethod(){
        // $app = Application::instance();
        // $app->db()->getArrayBySqlQuery("SELECT * FROM my_table");

        return "GeekUnivercity is awesome";
    }
}