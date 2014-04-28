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
            return Controller::getInstance($request->getNameController());
        return Controller::getInstance(Controller::defaultController);
    }
    
    /**
     *
     * @param Request $request 
     * @param Controller $controller
     * @return String
     */
    public function dispatchAction($request, $controller) {
        if(!$request->getNameAction())
            return $controller->getAction (Controller::defaultAction);
        $method = $controller->getAction($request->getNameAction());
        if($method)
            return $method;
        return $controller->getAction (Controller::defaultAction);  
    }

}

?>
