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
        $this->page->body .= $this->template('inscription', $args);
        echo $this->page->render();
    }
    
}
