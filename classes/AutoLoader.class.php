<?php
// Load my root class
require_once(__ROOT_DIR . '/classes/MyObject.class.php');
class AutoLoader {
	public function __construct() {
	spl_autoload_register(array($this, 'load'));
	}
	// This method will be automatically executed by PHP whenever it encounters
	// an unknown class name in the source code
	private function load($className) {
		$listeDesDossiers = array("classes", "controller", "model", "view");
		
		$estCeQuOnEnATrouveUn = false;
		for($i = 0; $i <4; $i++){
			$adresseFabriquee = __ROOT_DIR . "/" . $listeDesDossiers[$i] . "/" . ucfirst($className) . ".class.php";
			if (is_readable($adresseFabriquee)){
				require_once($adresseFabriquee);
				$estCeQuOnEnATrouveUn = true;
			}
			
		}
		if( $estCeQuOnEnATrouveUn == false){
			throw new Exception("AutoLoader.class.php n'a r�ussi � charger la classe " . $className );
		}
	}
}
$__LOADER = new AutoLoader();
?>