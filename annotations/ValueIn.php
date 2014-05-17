<?php

class ValueIn extends Requirement{
    public $value;
    
    public function check($arr, $name, $prev = null) {
        parent::check($arr, $name, $prev);
    }
}
