<?php

class Requires extends Annotation {
    public $method;
    public $name;
    public $requirement;
}

class Requirement extends Annotation{
    public function check($arr, $name, $prev = null){}
}

class DefaultValue extends Requirement {
    public $value;
    
    public function check($arr, $name, $prev = null) {
        if(isset($arr[$name]))
            return $arr[$name];
        return $this->value;
    }
}

class IsAdmin extends Requirement {
    public $value;
    
    public function check($arr, $name, $prev = null) {
        if(isset($arr[$name]))
            return $arr[$name]->admin;
        return false;
    }
}

class MustBeAdmin extends Requirement {
    public $value;
    
    public function check($arr, $name, $prev = null) {
        if(!(isset($arr[$name]) && $arr[$name]->admin))
            throw new MyHttpException(403, 'BAD');
        return true;
    }
}

class Required extends Requirement {
    
    public function check($arr, $name, $prev = null) {
        if(!isset($arr[$name]))
            throw new MyHttpException(400);
        return $arr[$name];
    }
}

class Action extends Annotation {
}
