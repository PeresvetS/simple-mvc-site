<?php

namespace simpleengine\controllers;

use simpleengine\models\DefaultModel;

class AuthController extends AbstractController
{
    public function actionLogin()
    {
        $model = new DefaultModel();

        echo $this->render("auth/login", [
            "public_url" => "../",
        ]);
    }


    public function actionRegister()
    {
        $model = new DefaultModel();

        echo $this->render("auth/register", [
            "public_url" => "../",
        ]);
    }

    public function actionDefault()
    {
    }
}