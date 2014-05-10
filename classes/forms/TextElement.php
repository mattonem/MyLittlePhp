<?php

class TextElement extends DescriptionElement{
    function accept($visitor) {
        return $visitor->visiteTextElement($this);
    }
}
