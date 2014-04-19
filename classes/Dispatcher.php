<?php

class Dispatcher {

    private static $instance;

    /**
     *  
     * @return Dispatcher 
     */
    public static function getCurrentDispatcher() {
        if (!self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     *
     * @param Request $request
     * @return String
     */
    public function dispatchController($request) {
        if($request->getNameController())
            return $request->getNameController ().'Controller';
        return Controller::defaultController.'Controller';
    }
    
    /**
     *
     * @param Request $request 
     * @param Controller $controller
     * @return String
     */
    public function dispatchAction($request, $controller) {
        $reflectionObject = new ReflectionObject($controller);
        $action = $request->getNameAction();
        if($request->getNameAction() && $reflectionObject->hasMethod($action.'Action'))
            return $request->getNameAction().'Action';
        else
            return Controller::defaultAction.'Action';       
    }

}

?>
