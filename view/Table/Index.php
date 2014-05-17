<?php
class Index extends View{
    
    /**
     * 
     * @param ActiveRecord\Table $models
     */
    public function render($models) {
        $content = "";
        foreach ($models as $table) {
            $content .= $this->template('tableLink', array(
                'name' => $table->table,
                'url' => Controller::urlFor("Table", "exploreTable", array(
                    'table' => $table->table,
                )),
            ));
        }
        
        $this->page->body .= $content;
        $this->finalize();
    }
}
