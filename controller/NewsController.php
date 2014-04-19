<?php

class NewsController extends Controller{

    public function defaultAction($args){
        echo "default";
    }
    
    function indexAction($args) {
        $models = News::findAll();
        $this->view("IndexView",$models);
    }
}

?>
