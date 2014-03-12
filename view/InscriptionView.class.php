<?php

class InscriptionView {
    
    /**
     * 
     * @param $args = array(
     *  'id'=> 'id de blabla',
     * )
     * 
     */
    public function render($args){
        ob_start(); 
        include 'templates/inscriptionTemplate.php';
    }
    
}
