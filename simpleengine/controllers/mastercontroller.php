<?php

namespace simpleengine\controllers;

use simpleengine\models\Master;

class MasterController extends AbstractController
{
    public function actionIndex()
    {   
        if ($this->isMaster()) { 

            $model = new Master();
            echo $this->render("default/index", [
                "isLogin" => $this->isLogin(),
                "isMaster" => $this->isMaster(),
                "public_url" => ""
            ]);
        }
        else {
            header("Location: /");
        }
    }
}