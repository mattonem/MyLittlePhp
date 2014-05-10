<?php

class CardWidget extends Widget{

    public function render($model) {
        if (is_string($model)) {
            return $this->template('card', array('content' => $model));
        }
        return $this->template('card', array('content' => $model->accept($this)));
    }
    
    public function visitNews($card) {
        return $this->template("news", array(
                            "url" => Controller::urlFor("News", "view", array("id" => $card->id)),
                            "title" => $card->name,
                            "date" => date("m.d.y", strtotime($card->date)),
                            "content" => $card->getContentHtml(),
                        ));
    }
}


