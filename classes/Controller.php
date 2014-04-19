<?php

abstract class Controller {
    const defaultAction = "default";
    const defaultController = "Anonymous";
    const title = "Undefined";

    public $page;
    
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

    abstract public function defaultAction($requete);

    /**
     *
     * @param string $action 
     */
    public function execute($action, $request) {
        $reflectionObject = new ReflectionObject($this);
        $methodArgs = $request->getNameAction() . "Args";
        $args = array();
        if ($reflectionObject->hasMethod($methodArgs))
            $args = $request->prepareForAction($this->$methodArgs());
        $this->$action($args);
    }

    public function redirect($controller, $action, $args = array()) {
        $this->page->head .= '<script type="text/javascript">window.history.pushState(null, null, "'.Controller::urlFor($controller,$action, $args).'");</script>';
        $controllerClass = $controller."Controller";
        $actionMethod = $action."Action";
        $controller = new $controllerClass($this->page);
        $controller->$actionMethod($args);
    }
    
    public function view($viewName, $args = null) {
        require_once 'view/'.$this->getName().'/'.$viewName.'.php';
        $view = new $viewName($this->page);
        $view->render($args);
    }

}

?>
