<?php
class ButtonWidget extends Widget{
    function render($url,$title , $type = "primary") {
        return $this->template('button', array(
            'url' => $url,
            'title' => $title,
            'type' => $type,
        ));
    }
}
