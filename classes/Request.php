<?php

class Request {

    private static $instance;

    public $SYS = array();

    // getInstance method 
    public static function getCurrentRequest() {
        if (!self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * 
     * @param Requires[] $requiresAnnotation
     * @return type
     */
    public function prepareForAction($requiresAnnotation) {
        $res = array();
        foreach ($requiresAnnotation as $requires) {
            switch ($requires->method) {
                case "GET":
                    $arr = $_GET;
                    break;
                case "POST":
                    $arr = $_POST;
                    break;
                case "SESSION":
                    $arr = array();
                    if(isset($_SESSION))
                        $arr = $_SESSION;
                    break;
                case "SYS":
                    $arr = $this->SYS;
                    break;
                default :
                    $arr = array();
            }
            $temp= null;
            if(!is_array($requires->requirement))
                $temp = $requires->requirement->check($arr, $requires->name);
            else {
                foreach ($requires->requirement as $req)
                    $temp = $req->check($arr, $requires->name, $temp);
            }
            $res[$requires->name] = $temp;
        }
        
        return $res;
    }

    public function addSystemArg($key, $value) {
        $this->SYS[$key] = $value; 
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
