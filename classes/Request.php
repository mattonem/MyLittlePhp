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
        foreach ($descriptionParams as $name => $requirements) {
            if (isset($_GET[$name]))
                $res[$name] = $_GET[$name];
            else {
                if (isset($requirements["default"]))
                    $res[$name] = $requirements["default"];
                else
                    throw new Exception("Param " . $name . " n'a pas ete renseigne");
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
