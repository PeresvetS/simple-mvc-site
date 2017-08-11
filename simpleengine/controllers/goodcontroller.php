<?php

namespace simpleengine\controllers;

use simpleengine\models\Good;
use simpleengine\models\Basket;

class GoodController extends AbstractController
{

    public function actionIndex()
    {   
        if ($this->isLogin()) {
            $basket = new Basket($_SESSION["user"]["id_user"]);
            $commonParams = $basket->getCommonParams();
        }
         if ($this->isPostReq()) {
                  $basket->doAction($_POST['action']);
        }
        $model = new Good();
        $goods = $model->findAll();
        echo $this->render("good/index", [
            "public_url" => "../",
            "isLogin" => $this->isLogin(),
            "isMaster" => $this->isMaster(),
            "goods" => $goods,
            "basketParams" => $commonParams || null
        ]);
    }
    

    public function actionItem()
    {   
        if ($this->isLogin()) {
            $basket = new Basket($_SESSION["user"]["id_user"]);
            $commonParams = $basket->getCommonParams();
        }
         if ($this->isPostReq()) {
                  $basket->doAction($_POST['action']);
        }
        $idGood = $_GET["id_good"];
        if (is_numeric($idGood)) {
            $idGood = $this->getSecureQuery($idGood);
            $model = new Good();
            $good = $model->find($idGood);
            echo $this->render("product/index", [
                "public_url" => "../",
                "isLogin" => $this->isLogin(),
                "isMaster" => $this->isMaster(),
                "good" => $good,
                "basketParams" => $commonParams || null
            ]);
        } 
        else {
             header("Location: /auth/login");
        }
    }

}