<?php
$configuration = [];


$configuration["ENVIRONMENT"] = "PROD";


$configuration["DIR"]["VIEWS"] = $_SERVER["DOCUMENT_ROOT"]."/../simpleengine/views/";


$configuration["DB"]["DB_HOST"] = "localhost";
$configuration["DB"]["DB_USER"] = "root"; 
$configuration["DB"]["DB_PASS"] = "***"; 
$configuration["DB"]["DB_NAME"] = "mvc-site"; 
$configuration["DB"]["DB_CHARSET"] = "UTF8";


$configuration["ROUTER"] = [
    "customController/<action>" => "controllers/CustomController/<action>",
    "<controller>/<action>" => "controllers/<controller>/<action>"
];


