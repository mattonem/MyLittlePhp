<?php
class IsAdmin extends Requirement {
    public $value;
    
    public function check($arr, $name, $prev = null) {
        if(isset($arr[$name]))
            return $arr[$name]->admin;
        return false;
    }
}
