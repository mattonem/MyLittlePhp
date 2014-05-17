<?php
class IndexTableWidget extends \Widget {

    public function render($models) {
        $res = '<table class="table">';
        $res .= $this->renderHeader($models[0]);
        foreach ($models as $model) {
            $res .= $this->renderInLine($model);
        }
        $res .= '</table>';
        return $res;
    }

    /**
     * 
     * @param Model $model
     */
    public function renderHeader($model) {
        $res = "";
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
     */
    public function renderInLine($model) {
        $res = "";
        $description = $model->description();
        foreach ($description as $element) {
            $name = strtolower($element->name);
            $res .= "<td>".$model->$name."</td>";
        }
        return '<tr>'.$res.'</tr>';
            
    }

}
