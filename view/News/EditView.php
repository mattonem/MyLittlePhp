<?php
class EditView extends View{
    
    /**
     * 
     * @param News $model
     */
    function render($model) {
        $this->page->body .= CardWidget::renderWidget(
            EditWidget::renderWidget(
                $model, 
                'Edit News', 
                Controller::urlFor('News', 'edit', array('id' => $model->id))
                ));
        $this->finalize();
    }
}
