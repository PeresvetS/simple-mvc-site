<?php


namespace simpleengine\controllers;


use simpleengine\core\Application;
use simpleengine\core\exception\ApplicationException;

abstract class AbstractController
{
    protected $requestedAction = "index";

    abstract public function actionIndex();

    protected function render(string $template = "", array $variables = []) : string{
        if($template == "")
            $template = $this->requestedAction;

        $dir = Application::instance()->get("DIR")["VIEWS"];
        $templateDir = mb_strtolower(substr(Application::instance()->router()->getController(), 0, -10), "UTF-8");

        try {
            $loader = new \Twig_Loader_Filesystem($dir);
            $twig = new \Twig_Environment($loader, []);
        }
        catch(\Exception $e){
            throw new ApplicationException("Template " . $dir . $template . " not found", 0504);
        }

        return $twig->render($templateDir. "/". $template.".tmpl", $variables);
    }

    public function setRequestedAction(string $actionName){
        $this->requestedAction = $actionName;
    }
}