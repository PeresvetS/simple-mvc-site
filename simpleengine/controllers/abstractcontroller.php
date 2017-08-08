<?php


namespace simpleengine\controllers;



use simpleengine\models\AuthorizationModel;
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
        $auth = new AuthorizationModel();
        return $auth->alreadyLoggedIn() || $auth->checkAuthWithCookie();
    }

    protected function isMaster() 
    {
        return $auth->isMaster();
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