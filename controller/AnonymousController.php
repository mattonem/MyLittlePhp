<?php

class AnonymousController extends Controller {

    public function defaultAction($requete) {
        $news = News::findAll();
        var_dump($news);
    }

    public function inscriptionArgs() {
        return array(
            "GET" => array(
                "id" => array(
                    "default" => 42,
                )
            )
        );
    }

    public function inscriptionAction($args) {
        $this->view("InscriptionView", $args);
    }

}

?>
