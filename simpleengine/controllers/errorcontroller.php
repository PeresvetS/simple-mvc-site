<?php

namespace simpleengine\controllers;

class ErrorController extends AbstractController
{
    public function actionIndex()
    {
        header("Location: /error/404");
    }

    public function action404()
    {
        echo $this->render("error/404", [
            "isLogin" => $this->isLogin(),
            "isMaster" => $this->isMaster(),
            "public_url" => "../",
            "basketParams" => null
        ]);
    }
}