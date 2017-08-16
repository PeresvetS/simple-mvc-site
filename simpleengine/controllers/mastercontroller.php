<?php

namespace simpleengine\controllers;

use simpleengine\models\Master;

class MasterController extends AbstractController
{
    public function actionIndex()
    {   
        if ($this->isMaster()) { 

            $master = new Master();
            $goods = $master->findAllGoods();
            echo $this->render("master/index", [
                "isLogin" => $this->isLogin(),
                "isMaster" => $this->isMaster(),
                "public_url" => "../",
                "basketParams" => null,
                "goods" => $goods
            ]);
        }
        else {
            header("Location: /");
        }
    }

    public function actionChangeGood()
    {
        if ($this->isPostReq()) {
            $master = new Master();
            $master->doAction($_POST["action"]);
        }
        else {
            header("Location: /");
        }
    }
     
}