<?php

class HtmlPage {

    public $head;
    public $body;
    public $title;
    public static $default_libraries = array('bootstrap.css');
    
    public function __construct() {
        $this->title = "title";
        $this->head .= '<meta charset="UTF-8">';
        $this->initLibraries();
    }
    
    public function initLibraries() {
        foreach (self::$default_libraries as $value) {
            $this->head .= FileLibrary::cssLink($value);
        }
    }

    public function render() {
        $this->head .= "<title>".$this->title."</title>";
        $doctype = '<!'.'DOCTYPE html>';
        $content = "<head>".$this->head."</head>";
        $content .= "<body>".$this->body."</body>";
        return $doctype."<html>".$content."</html>";
    }

}

?>
