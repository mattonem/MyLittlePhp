<?php
class Widget extends RenderingObject{
    
    public function render(){}
    
    public static function renderWidget() {
        $widget = new static();
        $render = new ReflectionMethod($widget, 'render');
        
        return $render->invokeArgs($widget, func_get_args());
    }
}

?>
