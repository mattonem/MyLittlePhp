<?php

class View extends RenderingObject{
    /**
     * @var HtmlPage 
     */
    public $page;
    public function __construct($page) {
        $this->page = $page;
    }

    public function finalize() {
        $output = $this->template("main", array(
            "head" => $this->page->finalizeHead(),
            "body" => $this->page->body,
        ));
        echo trim($output);
    }
}