<?php

namespace simpleengine\controllers;

use simpleengine\models\AuthorizationModel;

class AuthController extends AbstractController
{
    
    public function actionIndex()
    {
        location('/login/');
    }
   

    public function actionLogin()
    {
        $message = true;
        $isMaster = false; 
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result = AuthModel::authWithCredentials();

            $result ?
            location('/') :
            $message = false;
        }


        if ($this->isLogin()) {
            location('/');
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
            $result = AuthModel::registerCredentials();

            $result ?
            $message = 'success' :
            $message = 'error';
        }


        if ($this->isLogin()) {
            location('/');
        } 
        else {
            echo $this->render("auth/register", [
                "public_url" => "../",
                "message" => $message,
            ]);
        }
    }
}