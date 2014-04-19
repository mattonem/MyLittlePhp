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
                                "content" => $aNews->getContent(),
                            )));
        }

        $this->page->body .= $this->template("main", array("content" => $content));

        echo $this->page->render();
    }

}
