<?php

class IntegerElement extends DescriptionElement {
    public $ai = false;
    public $step = 1;
            
    function accept($visitor) {
        return $visitor->visiteIntegerElement($this);
    }
    
    
}
