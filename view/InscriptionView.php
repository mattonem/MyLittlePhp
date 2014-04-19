<?php

class InscriptionView extends View{
    
    /**
     * 
     * @param $args = array(
     *  'id'=> 'id de blabla',
     * )
     * 
     */
    public function render($args){
        $content = CardWidget::renderWidget($this->template('inscription', $args));
        $this->page->body .= $content;
        
        echo $this->page->render();
    }
    
}
