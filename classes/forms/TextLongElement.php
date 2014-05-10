<?php
class TextLongElement extends DescriptionElement{
    function accept($visitor) {
        return $visitor->visiteTextLongElement($this);
    }
}
