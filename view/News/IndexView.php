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
                                "title" => $aNews->getName(),
                                "date" => date("m.d.y", $aNews->getDate()),
                                "content" => $aNews->getContentHtml(),
                            )));
        }

       $this->page->body .=  $content;
       $this->finalize();
    }

}
