<?php
class ExceptionHandlerController extends Controller {

    /**
     *
     * @param HttpException $e 
     */
    public function defaultAction($e){
        if(!$e instanceof MyHttpException)
            $self->defaultAction(new HttpException(404, "Bad Request"));
        http_response_code($e->code);
        echo $e->message;
    }
}

?>
