<?php


namespace simpleengine\controllers;


use simpleengine\models\Order;

class OrderController extends AbstractController
{

    public function actionIndex()
    {
    $model = new Order();

    echo $this->render("order/index",[
        "public_url" => "../"
    ]);

    }

    public function actionAddproduct(){

    }

}