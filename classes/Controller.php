<?php
abstract class Controller {
	public $requete;
	
	public function __construct($request) {
		$this->requete = $request;
	}
	
	abstract public function defaultAction($requete );
	
	public function execute(){
		$reflectionObject = new ReflectionObject($this);
                $methodAction = $this->requete->getNameAction()."Action";
                $methodArgs = $this->requete->getNameAction()."Args";
                if($reflectionObject->hasMethod($methodAction)){
                    $args = array();
                    if($reflectionObject->hasMethod($methodArgs))
                        $args = $this->requete->prepareForAction($this->$methodArgs());
                    $this->$methodAction($args);   
                }
	}
}
?>
