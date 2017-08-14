<?php


namespace simpleengine\controllers;



use simpleengine\core\Authorization;
use simpleengine\core\Application;
use simpleengine\core\exception\ApplicationException;

abstract class AbstractController
{
    
    protected $requestedAction = "index";


    protected function isPostReq() : bool
    {
        return $_SERVER['REQUEST_METHOD'] == 'POST';
    }


    protected function isLogIn() : bool
    {
        return Authorization::alreadyLoggedIn() || Authorization::checkAuthWithCookie();
    }


    protected function isMaster() : bool
    {

        return Authorization::isMaster();
    }


    /**
     * getSecureQuery
     * @return mixed 
     */
    protected function getSecureQuery(string  $query, int $sub)
    {
        return Application::instance()->secure()->getSecureQuery($query, $sub);
    }


  
    abstract public function actionIndex();
    

    protected function render(string $template = "", array $variables = []) : string
    {
        $app = Application::instance();
        if($template == "") {
            $template = $this->requestedAction;
        }

        $dir = $app->get("DIR")["VIEWS"];
        $templateDir = mb_strtolower(substr($app->router()->getController(), 0, -10), "UTF-8");

        try {
            $loader = new \Twig_Loader_Filesystem($dir);
            $twig = new \Twig_Environment($loader, []);
        }
        catch(\Exception $e){
            header("Location: /error/404");
        }

        return $twig->render($template . ".tmpl", $variables);
    }

    
    public function setRequestedAction(string $actionName)
    {
        $this->requestedAction = $actionName;
    }
}