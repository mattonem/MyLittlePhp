<?php

class IndexView extends View {

    public function render($args) {
        $content = "";
        $models = $args["models"];
        foreach ($models as $aNews) {
            $content .= CardWidget::renderWidget(
                            $this->template("news", array(
                                "url" => Controller::urlFor("News", "View", array("id" => $aNews->getId())),
                                "title" => $aNews->getName(),
                                "date" => date("d/m/y", $aNews->getDate()),
                                "content" => $aNews->getContentHtml(),
                                "id" => $aNews->getID(),
            )));
        }

        $content .= PaginationWidget::renderWidget("News", "Index", $args["total"], array('page' => $args["page"]));
        $this->page->body .= $content;
        $this->finalize();
    }

}
