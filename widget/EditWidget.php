<?php
class EditWidget extends Widget{

    private $model;

    /**
     * 
     * @param \Model $model
     * @return string
     */
    public function render($model, $title, $url) {
        $this->model = $model;
        $output = "";
        foreach ($model->description() as $aDescriptionElement) {
            $output .= $aDescriptionElement->accept($this);
        }
        return $this->template('form', array(
            'title' => $title,
            'url' => $url,
            'content' => $output
        ));
    }
    
    /**
     * 
     * @param TextElement $textElement
     */
    function visiteTextElement($textElement) {
        $name = $textElement->name;
        return $this->template('textElement', array(
            'label' => $textElement->label,
            'value' => $this->model->$name,
            'name' => $name,
        ));
    }
    
    /**
     * 
     * @param TextLongElement $textElement
     */
    function visiteTextLongElement($textElement) {
        $name = $textElement->name;
        return $this->template('textLongElement', array(
            'label' => $textElement->label,
            'value' => $this->model->$name,
            'name' => $name,
        ));
    }
    
    /**
     * 
     * @param BooleanElement $booleanElement
     */
    function visitBooleanElement($booleanElement) {
        $name = $booleanElement->name;
        $value = ($this->model->$name)?"checked":'';
        return $this->template('booleanElement', array(
            'label' => $booleanElement->label,
            'value' => $value,
            'name' => $name,
        ));
    }
}
