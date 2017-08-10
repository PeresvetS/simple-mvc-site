<?php

namespace simpleengine\controllers;

use simpleengine\models\DefaultModel;

class DefaultController extends AbstractController
{
    public function actionIndex()
    {
        $model = new DefaultModel();

        echo $this->render("default/index", [
            "isLogin" => $this->isLogin(),
            "isMaster" => $this->isMaster(),
            "public_url" => ""
        ]);
    }

    public function actionDefault()
    {
        header("Location: /");
    }
}