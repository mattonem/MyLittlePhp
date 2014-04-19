<?php

class View {
    /**
     * @var HtmlPage 
     */
    public $page;
    public function __construct($page) {
        $this->page = $page;
    }


    public function template($name, $values) {
        $filename = 'templates/' . $name . 'Template.php';
        if (!file_exists($filename))
            return "null";
        $output = file_get_contents($filename);

        foreach ($values as $key => $value) {
            $tagToReplace = "[@$key]";
            $output = str_replace($tagToReplace, $value, $output);
        }
        return $output;
    }

}