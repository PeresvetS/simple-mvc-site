<?php
require_once("apptest.php");

class MyTestSuite extends \PHPUnit\Framework\TestSuite{
    public static function suite(){
        $suite = new MyTestSuite("TetsSet");
        $suite->addTestSuite('AppTest');
        return $suite;
    }
}
