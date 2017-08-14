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
        $loginMessage = 'success';
        
        if ($this->isPostReq()) {
            $authModel = new AuthModel();

            $authModel->auth() ?
            header("Location: /") :
            $loginMessage = 'error';
        }


        if ($this->isLogin()) {
             header("Location: /");
        }
        else {
            echo $this->render("auth/login", [
                "public_url" => "../",
                "message" => $loginMessage,
            ]);
        }

    }


    public function actionRegister()
    {
        $registerMessage = '';

        if ($this->isPostReq()){
            $authModel = new AuthModel();

            $authModel->register() ?
            $registerMessage = 'success' :
            $registerMessage = 'error';
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