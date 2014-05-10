<?php
class Required extends Requirement {
    
    public function check($arr, $name, $prev = null) {
        if(!isset($arr[$name]))
            throw new MyHttpException(400);
        return $arr[$name];
    }
}
