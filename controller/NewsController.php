<?php

class NewsController extends Controller{

    public function defaultAction($args){
        $this->redirect("News", "index");
    }
    
    function indexAction($args) {
        $models = News::findAll(array(), array('sort' => array('date' => 1)));
        $this->view("IndexView",$models);
    }
    
    function viewArgs() {
        return array(
            "GET" => array(
                "id" => array(
                     "default" => false,
                )
            )
        );
    }
    function viewAction($args) {
        if(!$args["id"])
            return $this->redirect ("News", "index");
        $model = News::findById($args["id"]);
        $this->view("ViewView",$model);
    }
}

?>
