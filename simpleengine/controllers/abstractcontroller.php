<?php


namespace simpleengine\controllers;



use simpleengine\core\Authorization;
use simpleengine\core\Application;
use simpleengine\core\exception\ApplicationException;

abstract class AbstractController
{
    
    // check state of user

    /**
     * isLogIn
     * @return bool 
     */
    protected function isLogIn() 
    {
        return Authorization::alreadyLoggedIn() || Authorization::checkAuthWithCookie();
    }


    /**
     * isMaster
     * @return bool 
     */
    protected function isMaster() : bool
    {

        return Authorization::isMaster();
    }


    /**
     * getSecureQuery
     * @param string $query 
     * @param number $sub 
     * @return mixed 
     */
    protected function getSecureQuery(string  $query, number $sub): mixed
    {
        return Application::instance()->secure()->getSecureQuery($query, $sub);
    }


    // render Page

    protected $requestedAction = "index";

    abstract public function actionIndex();

    /**
     * render
     * @param string $template 
     * @param array $variables 
     * @return string 
     */
    protected function render(string $template = "", array $variables = []) : string
    {
        if($template == "") {
            $template = $this->requestedAction;
        }

        $dir = Application::instance()->get("DIR")["VIEWS"];
        $templateDir = mb_strtolower(substr(Application::instance()->router()->getController(), 0, -10), "UTF-8");

        try {
            $loader = new \Twig_Loader_Filesystem($dir);
            $twig = new \Twig_Environment($loader, []);
        }
        catch(\Exception $e){
            throw new ApplicationException("Template " . $templateDir . $template . " not found", 0504);
        }

        return $twig->render($template . ".tmpl", $variables);
    }

    public function setRequestedAction(string $actionName)
    {
        $this->requestedAction = $actionName;
    }
}