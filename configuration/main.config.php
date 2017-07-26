<?php
$configuration = [];


$configuration["ENVIRONMENT"] = "PROD";


$configuration["DIR"]["VIEWS"] = $_SERVER["DOCUMENT_ROOT"]."/../simpleengine/views/";


$configuration["DB"]["DB_HOST"] = "localhost";
$configuration["DB"]["DB_USER"] = "root"; 
$configuration["DB"]["DB_PASS"] = "WU4qJkMfdJ5ABg3s"; 
$configuration["DB"]["DB_NAME"] = "homework5"; 
$configuration["DB"]["DB_CHARSET"] = "UTF8";


$configuration["ROUTER"] = [
    "customController/<action>" => "controllers/CustomController/<action>",
    "hello/<action>" => "controllers/HelloController/<action>",
    "<controller>/<action>" => "controllers/<controller>/<action>"
];


