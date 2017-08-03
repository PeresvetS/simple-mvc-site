<?php


namespace simpleengine\controllers;


use simpleengine\models\Good;

class GoodController extends AbstractController
{

    public function actionIndex()
    {
    $model = new Good();

    echo $this->render("good/index", []);
    }

    public function actionAddProduct(){

    }

}