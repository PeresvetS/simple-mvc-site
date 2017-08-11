<?php

namespace simpleengine\core;

use \simpleengine\core\Application;

class File
{


    
    /**
     * uploadFile
     * @return mixed 
     */
    public function uploadFile() : mixed
    {
        if (
        !isset($_FILES['img']['error']) ||
        is_array($_FILES['img']['error'])
        ) {
        throw new RuntimeException('Invalid parameters.');
        }

        if (is_uploaded_file($_FILES['img']['tmp_name'])) {
            $imgDir = $_SERVER['DOCUMENT_ROOT'] . '/public/img/' . basename($_FILES['img']['name']);
            
            if (move_uploaded_file($_FILES['img']['tmp_name'], $imgDir)) {
                return $imgDir;
            } 
        }
        return false;
    }
    

    /**
     * deleteFile
     * @param string $localPath
     */
    public function deleteFile(string $localPath) : bool
    {
        return unlink($localPath);
    }
}