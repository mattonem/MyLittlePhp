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
      echo $this->template('inscription', $args);
    }
    
}
