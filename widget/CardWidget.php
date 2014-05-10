<?php

class CardWidget extends Widget{

    public function render() {
        return $this->template('card', array('content' => func_get_arg(0)));
    }
}

?>
