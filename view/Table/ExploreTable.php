<?php
class ExploreTable extends View{
    public function render($models) {
        $content = "";
        $content .= ButtonWidget::renderWidget(
                    Controller::urlFor('Table', 'editTable', array('table' => get_class($models[0]))),
                    'Edit',
                    'primary'
                );
        $content .= IndexTableWidget::renderWidget(
                $models
                );
        
        $this->page->body .= $content;
        $this->finalize();
    }
}
