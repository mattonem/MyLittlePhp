<?php
class MustBeAdmin extends Requirement {
    public $value;
    
    public function check($arr, $name, $prev = null) {
        if (!(isset($arr[$name]) && $arr[$name]->admin)) {
            throw new MyHttpException(403, 'BAD');
        }
        return true;
    }
}
