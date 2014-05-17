<?php
class ExploreTable extends View{
    public function render($models) {
        $content = "";
        $content .= IndexTableWidget::renderWidget(
                $models
                );
        
        $this->page->body .= $content;
        $this->finalize();
    }
}
