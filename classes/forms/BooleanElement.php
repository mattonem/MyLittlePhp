<?php
class BooleanElement extends DescriptionElement{
    function accept($visitor) {
        return $visitor->visitBooleanElement($this);
    }
}
