<?php

class NewsController extends Controller{

    public function defaultAction($args){
        $this->redirect("News", "index");
    }
    
    function indexAction($args) {
        $models = News::findAll(array(), array('sort' => array('date' => 1)));
        $this->view("IndexView",$models);
    }
}

?>
