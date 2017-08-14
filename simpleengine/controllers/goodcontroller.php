<?php

namespace simpleengine\controllers;

use simpleengine\models\Good;
use simpleengine\models\Basket;

class GoodController extends AbstractController
{

    public function actionIndex()
    {   
        $commonParams = null;
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
            "basketParams" => $commonParams
        ]);
    }
    

    public function actionItem()
    {   
        $commonParams = null;
        if ($this->isLogin()) {
            $basket = new Basket($_SESSION["user"]["id_user"]);
            $commonParams = $basket->getCommonParams();
        }
         if ($this->isPostReq()) {
                  $basket->doAction($_POST['action']);
        }
        $idGood = $_GET["id"];
        if (is_numeric($idGood)) {
            $idGood = $this->getSecureQuery($idGood, 11);
            $model = new Good();
            $good = $model->find($idGood);
            $goods = $model->findFour();
            echo $this->render("good/item", [
                "public_url" => "../../",
                "isLogin" => $this->isLogin(),
                "isMaster" => $this->isMaster(),
                "good" => $good,
                "goods" => $goods,
                "basketParams" => $commonParams
            ]);
        } 
        else {
             header("Location: /auth/login");
        }
    }

}