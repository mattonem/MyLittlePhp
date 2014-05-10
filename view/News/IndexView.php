<?php

class IndexView extends View {

    public function render($args) {
        $content = "";
        $models = $args["models"];
        foreach ($models as $aNews) {
            $content .= CardWidget::renderWidget($aNews);
        }

        $content .= PaginationWidget::renderWidget("News", $args["action"], $args["total"], array('page' => $args["page"]));
        $this->page->body .= $content;
        $this->finalize();
    }

}
