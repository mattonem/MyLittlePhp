<?php
class Widget extends RenderingObject{
    
    public static function renderWidget() {
        $widget = new static();
        $render = new ReflectionMethod($widget, 'render');
        
        return $render->invokeArgs($widget, func_get_args());
    }
}


