<?php

namespace simpleengine\controllers;

use simpleengine\models\AuthModel;

class AuthController extends AbstractController
{
    
    public function actionIndex()
    {
       header("Location: /login/");
    }
   

    public function actionLogin()
    {
        $message = true;
        $isMaster = false; 
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result = AuthModel::auth();

            $result ?
             header("Location: /login/") :
            $message = false;
        }


        if ($this->isLogin()) {
             header("Location: /login/");
        }
        else {
            echo $this->render("auth/login", [
                "public_url" => "../",
                "message" => $message,
            ]);
        }

    }


    public function actionRegister()
    {
        $message = false;

        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result = AuthModel::register();

            $result ?
            $message = 'success' :
            $message = 'error';
        }


        if ($this->isLogin()) {
            header("Location: /");
        } 
        else {
            echo $this->render("auth/register", [
                "public_url" => "../",
                "message" => $message,
            ]);
        }
    }
}