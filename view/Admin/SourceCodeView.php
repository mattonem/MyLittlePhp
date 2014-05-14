<?php
class SourceCodeView extends View {
    function render($arg) {
        $content = $this->template("sourceCode", array(
            'commit' => $arg["commit"],
            'message' => $arg['message'],
            'update_url' => Controller::urlFor('Admin', 'sourceCode', array('perform' => 'update')),
            ));
        $this->page->body .=  $content;
        $this->finalize();
    }
}
