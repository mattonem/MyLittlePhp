<?php

class View {
  

  public function template($name){
    ob_start();
    include 'templates/'.$name.'Template.php';

  }

}