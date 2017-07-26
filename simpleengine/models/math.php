<?php


namespace simpleengine\models;


class Math
{
    public static function factorial($number){
        if($number == 0)
            return 1;
        else
            return $number * self::factorial($number - 1);
    }

    public function isEven($a){
        return ($a % 2 == 0) ? true : false;
    }
}