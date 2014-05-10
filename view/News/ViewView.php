<?php

class ViewView extends View{

    public function render($news) {
        $content = CardWidget::renderWidget($news);
        $this->page->body .=  $content;
        $this->finalize();
    }

}

