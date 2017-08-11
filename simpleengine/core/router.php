<?php
namespace simpleengine\core;
class Router
{
    private $urlData = [];
    private $package = "controllers";
    private $controller = "";
    private $action = "";
    private $parameter = "";

    public function __construct()
    {
        $urlParts = explode("?", $_SERVER["REQUEST_URI"]);
        $this->urlData["main"] = $urlParts[0];
        if(isset($urlParts[1])){
            $this->urlData["get"] = explode("&", $urlParts[1]);
        }
        $this->applyUrlMapping();
    }
    public function getController() : string {
        return $this->controller;
    }
    public function getAction() : string {
        return $this->action;
    }
    public function getPackage() : string {
        return $this->package;
    }
 
    private function applyUrlMapping(){
      
        if(!empty($this->urlData["main"])){
        
            $rules = Application::instance()->get("ROUTER");

          
            $activeRule = [];

         
            foreach($rules as $ruleSource => $ruleTarget) {
               
                $ruleData = explode("/", $ruleSource);

              
                $pcre = '/\/';

              
                foreach($ruleData as $rulePart){
                    if(mb_substr($rulePart, 0, 1, "UTF-8") != '<'){
                      
                        $pcre .= $rulePart.'\/';
                    }
                    else{
                       
                        $pcre .= '([a-z0-9-]+\/)*';
                    }
                }

                $pcre .= '/';

        
                if(preg_match($pcre, $this->urlData["main"])){
                    $activeRule['pattern'] = $ruleSource;
                    $activeRule['controller'] = $ruleTarget;
                    $activeRule['url'] = $this->urlData["main"];
                    break;
                }
            }


            if(!empty($activeRule)){
                $this->setUpRouting($activeRule);
            }
            
            else{
                $this->setUpRouting(
                    [
                        "pattern" => "controllers/DefaultController/default/index",
                        "controller" => "controllers/DefaultController/default/index",
                        "url" => $this->urlData["main"]
                    ]
                );
            }
        }
    }


    private function setUpRouting(array $activeRule){
        
        $urlParts = [];
        foreach(array_filter(explode("/", $activeRule['url'])) as $item){
            if(!empty($item))
                $urlParts[] = $item;
        }

        
        if(preg_match("/</", $activeRule["pattern"])) {
            
            foreach (explode("/", $activeRule["pattern"]) as $partKey => $patternPart) {
                $replacer = (isset($urlParts[$partKey]) ? $urlParts[$partKey] : "");

               
                if (preg_match("/</", $patternPart)) {
                    if (preg_match("/action/", $patternPart)) {
                        if($replacer != "")
                            $this->action = "action".ucfirst($replacer);
                        else
                            $this->action = "actionIndex";

                    }
                    if (preg_match("/controller/", $patternPart)) {
                        if($replacer != "")
                            $this->controller = ucfirst($replacer)."Controller";
                        else
                            $this->controller = "DefaultController";
                    }
                    if (preg_match("/parameter/", $patternPart)) {
                        $this->parameter = $replacer;
                    }

                    if (preg_match("/parameter/", $patternPart)) {
                        $this->parameter = $replacer;
                    }
                }
            }
        }

        $command = $activeRule['controller'];
        $commandParts = explode("/", $command);

        if(isset($commandParts[0]) && $commandParts[0] != "") {
            $this->package = $commandParts[0];
        }
       
        if($this->controller == ""){
            if(isset($commandParts[1])){
                if($commandParts[1] != ""){
                    $this->controller = $commandParts[1];
                }
                else{
                    $this->controller = ucfirst($commandParts[1])."Controller";
                }
            }
            else{
                $this->controller = "DefaultController";
            }
        }

       
        if($this->action == ""){
            if(isset($commandParts[2]) && $commandParts[2] != ""){
                $this->action = "action".ucfirst($commandParts[2]);
            }
            else{
                $this->action = "actionIndex";
            }
        }

        if($this->parameter == "" && isset($commandParts[3]) && $commandParts[3] != ""){
            $this->parameter = $commandParts[3];
        }
        else if($this->package == ""){
            $this->parameter = "parameter";
        }
    }


    public function getParameter() : string
    {
        return $this->parameter;
    }
}