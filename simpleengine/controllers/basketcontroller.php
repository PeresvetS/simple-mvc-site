<?php

namespace simpleengine\controllers;

use simpleengine\models\Basket;

class BasketController extends AbstractController
{
    public function actionIndex()
    {   
        $basket = new Basket($_SESSION["user"]["id_user"]);
        if ($this->isLogin()) {
            if ($this->isPostReq()) {
                  $basket->doAction($_POST['action']);
            }
            $basketGoods = $basket->getProductsArray();
            $commonParams = $basket->getCommonParams();
            echo $this->render("basket/index", [
                "public_url" => "../",
                "isLogin" => $this->isLogin(),
                "isMaster" => $this->isMaster(),
                "amount" => $_SESSION['amount'],
                "goods" => $basketGoods,
                "basketParams" => $commonParams
            ]);
        }
        else {
              header("Location: /auth/login");
        }
    }
}