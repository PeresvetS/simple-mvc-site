<?php


namespace simpleengine\controllers;


use simpleengine\models\Order;
use simpleengine\models\User;

class OrderController extends AbstractController
{

    public function actionIndex()
    {
        if ($this->isLogin()) {
            $idUser = $_SESSION["user"]["id_user"];
            $order = new Order($idUser);

            echo $this->render("order/index",[
                "public_url" => "../",
                "isLogin" => $this->isLogin(),
                "isMaster" => $this->isMaster(),
                "basketParams" => null,
                "amount" => $_SESSION["amount"]
            ]);
        }
        else {
             header("Location: /auth/login");
        }
    }

    public function actionCreateOrder()
    {
        if ($this->isPostReq()) {
            $order = new Order($_SESSION["user"]["id_user"]);
            $order->createOrder();
            // $order->sendInfoMail();
        }
        else {
            header("Location: /");
        }
    }
}