<?php
// Load my root class
class AutoLoader {
	public function __construct() {
            spl_autoload_register(array($this, 'load'));
	}
	// This method will be automatically executed by PHP whenever it encounters
	// an unknown class name in the source code
	private function load($className) {
		$listeDesDossiers = array("annotations", "classes", "classes/forms", "widget", "controller", "model");
		
		$estCeQuOnEnATrouveUn = false;
		foreach ($listeDesDossiers as $dossierName){
			$adresseFabriquee = __ROOT_DIR . "/" . $dossierName . "/" . ucfirst($className) . ".php";
			if (is_readable($adresseFabriquee)){
				require_once($adresseFabriquee);
				$estCeQuOnEnATrouveUn = true;
			}
			
		}
		if( $estCeQuOnEnATrouveUn == false){
			throw new Exception("AutoLoader.class.php n'a reussi a charger la classe " . $className );
		}
	}
}
$__LOADER = new AutoLoader();
