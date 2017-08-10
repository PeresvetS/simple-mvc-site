<?php


namespace simpleengine\controllers;


use simpleengine\models\Order;

class OrderController extends AbstractController
{

    public function actionIndex()
    {
    $idUser = $_SESSION["user"]["id_user"];
    $order = new Order($idUser);

    echo $this->render("order/index",[
        "public_url" => "../"
    ]);

    }

    public function actionAddproduct()
    {

    }

}