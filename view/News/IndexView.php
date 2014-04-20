<?php

class IndexView extends View {

    /**
     *
     * @param News[] $args 
     */
    public function render($args) {
        $content = "";

        foreach ($args as $aNews) {
            $content .= CardWidget::renderWidget(
                            $this->template("news", array(
                                "url" => Controller::urlFor("News", "View", array("id" => $aNews->getId())),
                                "title" => $aNews->getName(),
                                "date" => date("d/m/y", $aNews->getDate()),
                                "content" => $aNews->getContentHtml(),
                                "id" => $aNews->getID(),
                            )));
        }

       $this->page->body .=  $content;
       $this->finalize();
    }

}
