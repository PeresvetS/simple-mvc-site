<?php

namespace simpleengine\controllers;

use simpleengine\models\Basket;

class DefaultController extends AbstractController
{
    public function actionIndex()
    {
        if ($this->isLogin()) {
            $basket = new Basket($_SESSION["user"]["id_user"]);
            $commonParams = $basket->getCommonParams();
        }
        echo $this->render("default/index", [
            "isLogin" => $this->isLogin(),
            "isMaster" => $this->isMaster(),
            "public_url" => "",
            "basketParams" => $commonParams || null
        ]);
    }

    public function actionDefault()
    {
        header("Location: /");
    }
}