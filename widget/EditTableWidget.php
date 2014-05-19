<?php
class EditTableWidget extends Widget {
    
    private $_model;
    private $_iterator;
    private $_delete_url;

    /**
     * 
     * @param Model[] $models
     * @return string
     */
    function render($models, $title ,$url, $deleteUrl = false) {
        $this->_delete_url = $deleteUrl;
        $res = '<table class="table">';
        $res .= $this->renderHeader($models[0]);
        $this->_iterator = 0;
        foreach ($models as $model) {
            $res .= $this->renderInLine($model);
            $this->_iterator ++;
        }
        $res .= '</table>';
        return $this->template('form', array(
            'title' => $title,
            'content' => $res,
            'url' => $url,
        ));
    }
    
    /**
     * 
     * @param Model $model
     */
    public function renderHeader($model) {
        $res = "";
        if ($this->_delete_url) {
            $res .= "<th>delete</th>";
        }
        $description = $model->description();
        foreach ($description as $element) {
            $name = $element->name;
            $res .= "<th>".$name."</th>";
        }
        return '<tr>'.$res.'</tr>';
            
    }
    
    /**
     * 
     * @param Model $model
     * @return type
     */
    public function renderInLine($model) {
        $res = "";
        if ($this->_delete_url) {
            if ($model->id) {
                $res .= "<td>" . ButtonWidget::renderWidget(
                                $this->_delete_url . '&id=' . $model->id, 'delete', 'danger'
                        ) . "</td>";
            } else {
                $res .= "<td></td>";
            }
        }
        $description = $model->description();
        foreach ($description as $element) {
            $this->_model = $model;
            $input = $element->accept($this);
            $res .= "<td>".$input."</td>";
        }
        return '<tr>'.$res.'</tr>';
    }

    /**
     * 
     * @param FloatElement $aFloatElement
     */
    function visiteFloatElement($aFloatElement) {
        $name = strtolower($aFloatElement->name);
        return $this->template('floatElementInline', array(
            'name' => get_class($this->_model).'['.$this->_iterator.']['.$name.']',
            'value' => $this->_model->$name,
            'step' => $aFloatElement->step,
        ));
    }
    
    /**
     * 
     * @param TextElement $aTextElement
     */
    function visiteTextElement($aTextElement) {
        $name = strtolower($aTextElement->name);
        return $this->template('textElementInline', array(
            'name' => get_class($this->_model).'['.$this->_iterator.']['.$name.']',
            'value' => $this->_model->$name,
        ));
    }
    
    function visiteIntegerElement($aIntegerElement) {
        if($aIntegerElement->ai) {
            $name = strtolower($aIntegerElement->name);
            $res = $this->_model->$name;
            $res .= $this->template('hiddenElement', array(
                'name' => get_class($this->_model).'['.$this->_iterator.']['.$name.']',
                'value' => $this->_model->$name,
                ));
            return $res;
        }
            
        $name = strtolower($aIntegerElement->name);
        return $this->template('floatElementInline', array(
            'name' => get_class($this->_model).'['.$this->_iterator.']['.$name.']',
            'value' => $this->_model->$name,
            'step' => $aIntegerElement->step,
        ));
    }
}
