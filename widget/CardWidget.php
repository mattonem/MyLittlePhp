<?php

class CardWidget extends Widget{

    public function render() {
        return '<div class="card">'.func_get_arg(0).'</div>';
    }
}

?>
