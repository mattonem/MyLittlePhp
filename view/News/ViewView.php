<?php

class ViewView extends View{

    public function render($news) {
        $content = CardWidget::renderWidget(
                        $this->template("news", array(
                            "url" => Controller::urlFor("News", "View", array("id" => $news->getId())),
                            "title" => $news->getName(),
                            "date" => date("m.d.y", $news->getDate()),
                            "content" => $news->getContentHtml(),
                        )));
        $this->page->body .=  $content;
        $this->finalize();
    }

}

?>
