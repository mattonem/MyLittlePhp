<?php
class MyHttpException extends Exception{
    public $code;
    public $message;
    
    public function __construct($code, $message = null) {
        $this->code = $code;
        $this->message = $message;
    }
    
}

?>
