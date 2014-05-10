<?php
abstract class Model extends ActiveRecord\Model{
    /**
     * 
     * @return DescriptionElement[]
     */
    public function description() {
        return array();
    }
}
