<?php


namespace simpleengine\controllers;


use simpleengine\models\Order;
use simpleengine\models\User;
use simpleengine\models\Basket;

class OrderController extends AbstractController
{

    public function actionIndex()
    {
        if ($this->isLogin()) {
            $userId = $_SESSION["user"]["id_user"];
            $order = new Order($userId);
            $message = "none";

            if ($this->isPostReq()) {
                $result = $order->save();
                if ($result) {
                    $message = "success";
                     $basket = new Basket($userId);
                     $basket->delete();
                     $_SESSION["amount"] = 0;
                }
                else {
                    $message = "error";
                }
            }


            echo $this->render("order/index",[
                "public_url" => "../",
                "isLogin" => $this->isLogin(),
                "isMaster" => $this->isMaster(),
                "basketParams" => null,
                "amount" => $_SESSION["amount"],
                "message" => $message
            ]);
        }
        else {
             header("Location: /auth/login");
        }
    }
}