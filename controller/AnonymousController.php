<?php

class AnonymousController extends Controller {

    public function defaultAction($requete) {
        $news = News::findAll();
        $news[0]->setName('blabla')->save();
        var_dump($news);
    }

    public function inscriptionArgs() {
        return array(
            "id" => array(
                'default' => 0
            )
        );
    }

    public function inscriptionAction($args) {
        $view = new InscriptionView($this->page);
        $view ->render($args);
    }

}

?>
