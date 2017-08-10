<?php

namespace simpleengine\core;

use \simpleengine\core\Application;

class File
{

    /**
     * uploadFile
     * @param string $localPath  
     */
    public function uploadFile(string $localPath)
    {

    }
    

    /**
     * deleteFile
     * @param string $localLink
     */
    public function deleteFile(string $localPath)
    {
        try {

        } 
        catch (Exception $e) {
            $msg = $e->getMessage()."<br>";
            $msg .= "<pre>" . $e->getTraceAsString() . "</pre>";
            echo $msg;
        }
    }
}