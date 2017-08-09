<?php

namespace simpleengine\controllers;

use simpleengine\models\Product;

class ProductController extends AbstractController
{

    // gb.local/product/index/
    public function actionIndex()
    {
        $idGood = $this->getSecureQuery($_GET["id_good"]);
        $good = new Product($idGood);

        echo $this->render("product/index", [
            "public_url" => "../",
            "isLogin" => $this->isLogin(),
            "isMaster" => $this->isMaster(),
            "good" => $good,
        ]);
    }

    // gb.local/product/item/?id_product=123
    // gb.local/product/item/123/
    public function actionItem()
    {
       
    }
}