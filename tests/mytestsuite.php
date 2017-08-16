<?php


require_once("apptest.php");


class MyTestSuite extends \PHPUnit\Framework\TestSuite{

    public static function suite(){
        $suite = new MyTestSuite("TestSet");
        $suite->addTestSuite('AppTest');
        return $suite;
    }


}
