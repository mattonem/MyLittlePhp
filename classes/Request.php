<?php

class Request {

    private static $instance;

   

    // getInstance method 
    public static function getCurrentRequest() {
        if (!self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function prepareForAction($descriptionParams) {
        $res = array();
        foreach ($descriptionParams as $method => $requirements) {
            switch ($method) {
                case "GET":
                    $arr = $_GET;
                    break;
                case "POST":
                    $arr = $_POST;
                    break;
                case "SESSION":
                    $arr = $_SESSION;
                    break;
                default :
                    $arr = array();
            }
            $res = array_merge($res, $this->chechArrFor($arr, $requirements));
        }
        
        return $res;
    }
    
     public function chechArrFor($arr, $requirements) {
         $res = array();
         foreach ($requirements as $name => $requirement) {
             foreach ($requirement as $key => $value) {
                 
                 switch ($key) {
                     case "required":
                         if(!isset($arr[$name]))
                             throw new Exception("La valeur ".$name. " doit etre set.");
                         break;
                     case "default":
                         
                         if(!isset($arr[$name]))
                             $res[$name] = $value;
                         else
                             $res[$name] = $arr[$name];
                         break;
                 }
             }
         }
         return $res;
    }

    public function getNameAction() {
        if (!isset($_GET['action']))
            return 'default';
        return $_GET['action'];
    }

    public function getNameController() {
        if (!isset($_GET['controller']))
            return false;
        return $_GET['controller'];
    }

    public function getNameView() {
        if (!isset($_GET['view']))
            return false;
        return $_GET['view'];
    }

}

?>
