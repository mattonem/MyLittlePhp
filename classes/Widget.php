<?php
class Widget {
    
    public function render($content){}
    
    public static function renderWidget($content) {
        $widget = new static();
        return $widget->render($content);
    }
}

?>
