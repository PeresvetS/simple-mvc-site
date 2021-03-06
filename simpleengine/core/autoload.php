<?php
spl_autoload_register("simpleEngineAutoloader");

function simpleEngineAutoloader($class)
{

    $class_data = explode("\\", $class);

    $path = __DIR__."/../../";


    foreach($class_data as $item) {
        $path .= "/".strtolower($item);
    }

    $path .= ".php";

    if(file_exists($path)) {
        require_once($path);
    }
    else {
        // header("Location: /error/404");
        throw new Exception("Class " . $class . " wasn't found in ".$path, 0404);
    }
}