<?php

class InscriptionView extends View{
    
    public function render($args){
        $content = CardWidget::renderWidget($this->template('inscription', $args));
        $this->page->body .= $content;
        
        echo $this->page->render();
    }
    
}
