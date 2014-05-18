<?php
abstract class Model extends ActiveRecord\Model{
    
    /**
     * This method highy depend on php-active-record
     * @return DescriptionElement[]
     */
    public function autoDescription() {
        $arr = array();
        foreach ($this::table()->columns as $aColumn) {
            switch ($aColumn->raw_type) {
                case "int":
                    $el = IntegerElement::create($aColumn->name, $aColumn->name);
                    if ($aColumn->auto_increment) {
                        $el->ai = true;
                    }
                    $arr[] = $el;
                    break;
                case "float":
                    $arr[]= FloatElement::create($aColumn->name, $aColumn->name);
                    break;
                case "varchar":
                    $arr[]= TextElement::create($aColumn->name, $aColumn->name);
                    break;
            }
        }
        return $arr;
    }
    
    /**
     * 
     * @return DescriptionElement[]
     */
    public function description() {
        return array();
    }
}
