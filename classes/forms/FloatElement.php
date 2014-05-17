<?php
class FloatElement extends DescriptionElement{

    public $step = 0.000000001;

    function accept($visitor) {
        return $visitor->visiteFloatElement($this);
    }
}
