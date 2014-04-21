<?php
class EditView extends View{
    
    /**
     * 
     * @param News $model
     */
    function render($model) {
        $this->page->body .= CardWidget::renderWidget(
        $this->template("editNews", array(
            "url" => Controller::urlFor("News", "edit", array("id" => $model->id)),
            "name" => $model->name,
            "content" => News::br2nl($model->content),
            "published" => ($model->published)?"checked":"",
        )));
        $this->finalize();
    }
}
