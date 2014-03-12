<?php
class AnonymousController extends Controller{

	public function defaultAction($requete ){
            echo "coucou";
	}
        
        
        public function inscriptionArgs() {
            return array(
                "id" => array(
                    'default' => 0
                    )
                );
        }
        public function inscriptionAction($args) {
            $view = new InscriptionView();
            $view->render($args);
        }
}
?>
