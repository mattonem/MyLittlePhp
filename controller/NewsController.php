<?php

class NewsController extends Controller{

    public function defaultAction($args){
        echo "default";
    }
    
    function indexAction($args) {
        $models = News::findAll(array(), array('sort' => array('date' => 1)));
        $this->view("IndexView",$models);
    }
}

?>
