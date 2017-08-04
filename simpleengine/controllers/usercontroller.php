<?php


namespace simpleengine\controllers;

use simpleengine\models\User;

class UserController extends AbstractController
{

    public function actionIndex()
    {
        $model = new User();

        echo $this->render("user/index", [
            "public_url" => "../"
        ]);
    }
}