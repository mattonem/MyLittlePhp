<?php

class RenderingObject {
    public function template($name, $values, $_class = false) {
        $class = new ReflectionAnnotatedClass($this);
        if($_class){
            $class = $_class;
        }
        $filename = dirname($class->getFileName()).'/templates/' . $name . 'Template.php';
        if (!file_exists($filename)) {
            if ($class->getName() == "RenderingObject") {
                throw new MyHttpException(500, "template ". $name. " does'nt existe.");
            }
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
    
}
