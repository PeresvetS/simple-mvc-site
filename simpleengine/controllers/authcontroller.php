<?php

namespace simpleengine\controllers;

use simpleengine\models\AuthorizationModel;

class AuthController extends AbstractController
{
    
    public function actionIndex(){}
   

    public function actionLogin()
    {
        if ($this->isLogin()) {
            location('/');
        } 
        else {
            echo $this->render("auth/login", [
                "public_url" => "../",
            ]);
        }
    }


    public function actionRegister()
    {

        if ($this->isLogin()) {
            location('/');
        } 
        else {
            echo $this->render("auth/register", [
                "public_url" => "../",
            ]);
        }
    }


    public function actionMaster()
    {
        if ($this->isLogin()) {
            location('/');
        } 
        else {
            echo $this->render("auth/master", [
                "public_url" => "../",
            ]);
        }
    }
}