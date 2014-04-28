<?php

class IndexView extends View {

    public function render($args) {
        $content = "";
        $models = $args["models"];
        foreach ($models as $aNews) {
            $content .= CardWidget::renderWidget(
                            $this->template("news", array(
                                "url" => Controller::urlFor("news", "view", array("id" => $aNews->id)),
                                "title" => $aNews->name,
                                "date" => date("m.d.y", strtotime($aNews->date)),
                                "content" => $aNews->getContentHtml(),
                                "id" => $aNews->id,
            )));
        }

        $content .= PaginationWidget::renderWidget("News", $args["action"], $args["total"], array('page' => $args["page"]));
        $this->page->body .= $content;
        $this->finalize();
    }

}
