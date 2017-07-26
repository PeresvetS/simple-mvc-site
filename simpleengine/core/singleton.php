<?php


namespace simpleengine\core;

trait Singleton {
    static private $instance = null;

    private function __construct() { }  
    private function __clone() { }  
    private function __wakeup() { }  

    /**
     * @return self
     */
    static public function instance() {
        return
            self::$instance===null
                ? self::$instance = new static()//new self()
                : self::$instance;
    }
}