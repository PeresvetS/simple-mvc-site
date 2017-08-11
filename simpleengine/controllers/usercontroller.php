<?php


namespace simpleengine\controllers;

use simpleengine\models\User;

class UserController extends AbstractController
{

    public function actionIndex()
    {
        if ($this->isLogin()) {
            
            $user = new User($_SESSION['user']['id_user']);

            echo $this->render("user/index", [
                "public_url" => "../",
                "isLogin" => $this->isLogin(),
                "isMaster" => $this->isMaster(),
                "basketParams" => null,
            ]);
        }
        else {
            header("Location: /auth/login");
        }
       
    }
}