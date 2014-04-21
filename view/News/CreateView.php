<?php
class CreateView extends View{
    
    /**
     * 
     * @param News $model
     */
    public function render($model) {
        $this->page->body .= CardWidget::renderWidget(
        $this->template("editNews", array(
            "url" => Controller::urlFor("News", "create"),
            "name" => $model->name,
            "content" => $model->content,
            "published" => "",
        )));
        $this->finalize();
    }
}
