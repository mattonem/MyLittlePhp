<?php

class ViewView extends View{

    public function render($news) {
        $content = CardWidget::renderWidget(
                        $this->template("news", array(
                            "url" => Controller::urlFor("News", "View", array("id" => $news->id)),
                            "title" => $news->name,
                            "date" => date("m.d.y", strtotime($news->date)),
                            "content" => $news->getContentHtml(),
                        )));
        $this->page->body .=  $content;
        $this->finalize();
    }

}

?>
