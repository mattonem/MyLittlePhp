<?php
class CreateView extends View{
    
    /**
     * 
     * @param News $model
     */
    function render($model) {
        $this->page->body .= CardWidget::renderWidget(
            EditWidget::renderWidget(
                $model, 
                'Create News', 
                Controller::urlFor('News', 'create')
                ));
        $this->finalize();
    }
}
