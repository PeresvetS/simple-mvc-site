<?php

namespace simpleengine\core;

use \simpleengine\core\Application;

class File
{


    
    public function uploadFile() : string
    {
        $imgPath = '';
        if (is_uploaded_file($_FILES['img']['tmp_name'])) {
            $imgPath = 'img/' . basename($_FILES['img']['name']);
            $impPathFull = $_SERVER['DOCUMENT_ROOT'] . "/$imgPath";
            
            if (move_uploaded_file($_FILES['img']['tmp_name'], $impPathFull)) {
                return $imgPath;
            } 
        }
        return $imgPath;
    }
    

    
    public function deleteFile(string $localPath) : bool
    {
        $fullPath = $_SERVER['DOCUMENT_ROOT'] . "/$localPath";
        if(file_exists($fullPath)) {
                return unlink($fullPath);
        }
        return false;
    }
}