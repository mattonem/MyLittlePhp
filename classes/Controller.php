<?php

abstract class Controller {
    const defaultAction = "defaultAction";
    const defaultController = "Anonymous";
    const title = "Undefined";

    public $page;
    
    public function getActions(){
        $ref = new ReflectionAnnotatedClass($this);
        $res = array();
        foreach ($ref->getMethods() as $method) {
            if($method->hasAnnotation('Action'))
                $res[] = $method;
        }
        return $res;
    }
    
    public function getAction($name){
        $actions = $this->getActions();
        foreach ($actions as $action){
            if($action->name == $name)
                return $action;
        }
        return null;
    }
    
    public static function getInstance($name, $htmlPage = null){
        $class = $name.'Controller';
        return new $class($htmlPage);
    }

    public function getName() {
        return substr(get_class($this), 0, strlen(get_class($this)) - 10);
    }
    
    public static function urlFor($controller, $action, $arg = array()) {
        $ret = "?controller=".$controller."&action=".$action;
        foreach ($arg as $param => $value) {
            $ret .= '&'.$param.'='.$value;
        }
        return $ret;
    }

    public function __construct($page = null) {
        if ($page)
            $this->page = $page;
        else
            $this->page = new HtmlPage();
        $this->page->title = self::title;
    }

    /**
     * @Action
     */
    abstract public function defaultAction($requete);

    /**
     *
     * @param string $action 
     */
    public function execute($action, $override = array()) {
        $allAnnotations = $action->getAllAnnotations('Requires');
        $args = Request::getCurrentRequest()->prepareForAction($allAnnotations);
        $args = array_merge($args, $override);
        $action->invoke($this,$args);
    }

    public function redirect($controllerName, $action, $args = array()) {
        $newController = self::getInstance($controllerName, $this->page);
        $this->page->head .= '<script type="text/javascript">'
                . 'window.history.pushState(null, null, "'.Controller::urlFor($controllerName,$action, $args).'");'
                . '</script>';
        $actionMethod = $newController->getAction($action);
        $newController->execute($actionMethod, $args);
    }
    
    public function callView($viewName, $args = null) {
        require_once 'view/'.$this->getName().'/'.$viewName.'.php';
        $view = new $viewName($this->page);
        $view->render($args);
    }

}

?>
