<?php
class EditTable extends View{
    public function render($models) {
        $content = "";
        $content .= EditTableWidget::renderWidget(
                $models, 
                'Edit', 
                Controller::urlFor('Table', 'editTable', array('table' => get_class($models[0]))),
                Controller::urlFor('Table', 'deleteElement', array('table' => get_class($models[0])))
                );
        
        $this->page->body .= $content;
        $this->finalize();
    }
}
