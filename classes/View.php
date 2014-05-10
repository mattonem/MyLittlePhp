<?php

class View {
    /**
     * @var HtmlPage 
     */
    public $page;
    public function __construct($page) {
        $this->page = $page;
    }
    

    public function template($name, $values, $_class = false) {
        $class = new ReflectionAnnotatedClass($this);
        if($_class){
            $class = $_class;
        }
        $filename = dirname($class->getFileName()).'/templates/' . $name . 'Template.php';
        if (!file_exists($filename)) {
            return $this->template($name, $values, $class->getParentClass());
        }
        $output = file_get_contents($filename);
        $output = trim(preg_replace('/\s+/', ' ', $output));
        foreach ($values as $key => $value) {
            $tagToReplace = "[@$key]";
            $output = str_replace($tagToReplace, $value, $output);
        }
        return $output;
    }

    public function finalize() {
        $output = $this->template("main", array(
            "head" => $this->page->finalizeHead(),
            "body" => $this->page->body,
        ));
        echo trim($output);
    }
}