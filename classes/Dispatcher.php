<?php
class Dispatcher {

	private static $instance; 
	private function __construct() { } 

	// getInstance method 
	public static function getCurrentDispatcher() {
		if(!self::$instance) { 
		  self::$instance = new self(); 
		} 

		return self::$instance; 
	} 
	
	public function dispatch($request){
		switch($request->getNameController()){
			case "user":
				$controller = new UserController($request);
				break;
			case "admin":
				$controller = new AdminController($request);
				break;
			default:
				$controller = new AnonymousController($request);
				break;
		}
		return $controller;
	}
	
	
}
?>
