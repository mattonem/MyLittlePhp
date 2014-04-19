<?php
error_reporting(E_ALL);
ini_set("display_errors", E_ALL);
// define __ROOT_DIR constant which contains the absolute path on disk
// of the directory that contains this file (index.php)
// e.g. http://isic.mines-douai.fr/web01/index.php => __ROOT_DIR = /home/web01/public_html
$rootDirectoryPath = realpath(dirname(__FILE__));
define ('__ROOT_DIR', $rootDirectoryPath );
// define __BASE_URL constant which contains the URL PATH of the index.php
// e.g. http://isic.mines-douai.fr/web01/index.php => __BASE_URL = /web01
$base_url = explode('/',$_SERVER['PHP_SELF']);
array_pop($base_url);
define ('__BASE_URL', implode('/',$base_url) );
// Load the Loader and Libs class to automatically load classes when needed
require_once(__ROOT_DIR . '/lib/BaseMongoRecord.php');
require_once(__ROOT_DIR . '/classes/AutoLoader.php');

// Connect database
BaseMongoRecord::$connection = new Mongo();
BaseMongoRecord::$database = 'mylittlephp';

// Reify the current request
$request = Request::getCurrentRequest();
try {
	$controller = Dispatcher::getCurrentDispatcher()->dispatch($request);
	$controller->execute();
} catch (Exception $e) {
	echo 'Error : ' . $e->getMessage() . "\n";
}
?>																																										
