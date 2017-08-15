<?php

namespace simpleengine\controllers;

use simpleengine\models\Good;
use simpleengine\models\Basket;

class DefaultController extends AbstractController
{
    public function actionIndex()
    {   
        $canBuy = null;
        $commonParams = null;
        if ($this->isLogin()) {
            $canBuy = "canBuy";
            $idUser = (int)$_SESSION["user"]["id_user"];
            $basket = new Basket($idUser);
            $commonParams = $basket->getCommonParams();
        }

        $model = new Good();
        $goods = $model->findFour();
        echo $this->render("default/index", [
            "isLogin" => $this->isLogin(),
            "isMaster" => $this->isMaster(),
            "canBuy" => $canBuy,
            "public_url" => "",
            "goods" => $goods,
            "basketParams" => $commonParams,
        ]);
    }

    public function actionDefault()
    {
        header("Location: /");
    }
}