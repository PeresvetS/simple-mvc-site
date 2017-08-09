<?php

namespace simpleengine\controllers;

use simpleengine\models\Good;

class GoodController extends AbstractController
{

    public function actionIndex()
    {   
        $goods = new Good($_SESSION['user']['id_user']);

        echo $this->render("good/index", [
            "public_url" => "../",
            "isLogin" => $this->isLogin(),
            "isMaster" => $this->isMaster(),
            "goods" => $goods,
        ]);
    }
    

    public function actionAddProduct()
    {

    }

}