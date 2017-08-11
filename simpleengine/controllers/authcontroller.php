<?php

namespace simpleengine\controllers;

use simpleengine\models\AuthModel;

class AuthController extends AbstractController
{
    
    public function actionIndex()
    {
       header("Location: /auth/login");
    }
   

    public function actionLogin()
    {
        $successLogin = true;
        $isMaster = false; 
        
        if ($this->isPostReq()) {

            AuthModel::auth() ?
            header("Location: /") :
            $successLogin = false;
        }


        if ($this->isLogin()) {
             header("Location: /");
        }
        else {
            echo $this->render("auth/login", [
                "public_url" => "../",
                "message" => $successLogin,
            ]);
        }

    }


    public function actionRegister()
    {
        $registerMessage = null;

        if ($this->isPostReq()){

            AuthModel::register() ?
            $message = 'success' :
            $message = 'error';
        }


        if ($this->isLogin()) {
            header("Location: /");
        } 
        else {
            echo $this->render("auth/register", [
                "public_url" => "../",
                "message" => $registerMessage,
            ]);
        }
    }


    public function actionLogout()
    {
        unset($_SESSION["user"]);
        session_destroy();
        header("Location: /");
    }
}