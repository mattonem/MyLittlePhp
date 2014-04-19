<?php

abstract class Controller {
    const defaultAction = "default";
    const defaultController = "Anonymous";
    public $requete;

    public function __construct($request) {
        $this->requete = $request;
    }

    abstract public function defaultAction($requete);

    /**
     *
     * @param string $action 
     */
    public function execute($action) {
        $reflectionObject = new ReflectionObject($this);
        $methodArgs = $this->requete->getNameAction() . "Args";
        $args = array();
        if ($reflectionObject->hasMethod($methodArgs))
            $args = $this->requete->prepareForAction($this->$methodArgs());
        $this->$action($args);
    }

}

?>
