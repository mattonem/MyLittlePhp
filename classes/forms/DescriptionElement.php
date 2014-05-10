<?php

abstract class DescriptionElement {

    public $name;
    public $label;

    public function accept($visitor){
        
    }
    
    public function __construct($name, $label) {
        $this->name = $name;
        $this->label = $label;
    }
    
    public static function create($name, $label) {
        return new static($name, $label);
    }
}
