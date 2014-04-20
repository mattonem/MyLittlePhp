<?php
class LoginView extends View{
    public function render($args) {
        $this->page->body .= CardWidget::renderWidget($this->template("login", array(
            "url" => Controller::urlFor("Anonymous", "login"),
            "msg" => $args["msg"],
        )));
        $this->finalize();
    }
}

?>
