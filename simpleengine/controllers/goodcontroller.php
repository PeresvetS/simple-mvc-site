<?php

namespace simpleengine\controllers;

use simpleengine\models\Good;

class GoodController extends AbstractController
{

    public function actionIndex()
    {   
        $model = new Good();
        $goods = $model->findAll();
        echo $this->render("good/index", [
            "public_url" => "../",
            "isLogin" => $this->isLogin(),
            "isMaster" => $this->isMaster(),
            "goods" => $goods,
        ]);
    }
    

    public function actionItem()
    {   
        $idGood = $_GET["id_good"];
        if(is_numeric($idGood)) {
            $idGood = $this->getSecureQuery($idGood);
            $model = new Good();
            $good = $model->find($idGood);
            echo $this->render("product/index", [
                "public_url" => "../",
                "isLogin" => $this->isLogin(),
                "isMaster" => $this->isMaster(),
                "good" => $good,
            ]);
        } 
        else {
             header("Location: /login/");
        }
    }

}