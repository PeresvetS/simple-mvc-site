<?php

namespace simpleengine\controllers;

use simpleengine\models\DefaultModel;

class DefaultController extends AbstractController
{
    public function actionIndex()
    {
        $model = new DefaultModel();

        echo $this->render("default/index", [
            "info" => $model->testMethod()
        ]);
    }

    public function actionDefault(){
    }
}