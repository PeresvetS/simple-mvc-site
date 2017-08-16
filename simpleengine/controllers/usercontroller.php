<?php


namespace simpleengine\controllers;

use simpleengine\models\User;
use simpleengine\models\Order;

class UserController extends AbstractController
{

    public function actionIndex()
    {
        if ($this->isLogin()) {
            $userId = $_SESSION['user']['id_user'];
            $user = new User($userId);
            $order = new Order($userId);
            $orders = $order->find($userId);
            $result = '';
            if ($this->isPostReq()) {
                $result = $user->doAction($_POST["action"]);
            }

            echo $this->render("user/index", [
                "public_url" => "../",
                "isLogin" => $this->isLogin(),
                "isMaster" => $this->isMaster(),
                "basketParams" => null,
                "orders" => $orders,
                "message" => $result
            ]);
        }
        else {
            header("Location: /auth/login");
        }
       
    }
}