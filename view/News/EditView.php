<?php
class EditView extends View{
    
    /**
     * 
     * @param News $model
     */
    function render($model) {
        $this->page->body .= CardWidget::renderWidget(
        $this->template("editNews", array(
            "url" => Controller::urlFor("News", "edit", array("id" => $model->getID())),
            "name" => $model->getName(),
            "content" => $model->getContent(),
            "published" => $model->getPublished(),
        )));
        $this->finalize();
    }
}
