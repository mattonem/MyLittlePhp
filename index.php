<?php
error_reporting(E_ALL);
ini_set("display_errors", E_ALL);
// define __ROOT_DIR constant which contains the absolute path on disk
// of the directory that contains this file (index.php)
$rootDirectoryPath = realpath(dirname(__FILE__));
define('__ROOT_DIR', $rootDirectoryPath);
// define __BASE_URL constant which contains the URL PATH of the index.php
$base_url = explode('/', $_SERVER['PHP_SELF']);
array_pop($base_url);
define('__BASE_URL', implode('/', $base_url));
// Load the Loader and Libs class to automatically load classes when needed
require_once(__ROOT_DIR . '/lib/BaseMongoRecord.php');
require_once(__ROOT_DIR . '/classes/AutoLoader.php');

// Connect database
BaseMongoRecord::$connection = new Mongo();
BaseMongoRecord::$database = 'mylittlephp';

// Reify the current request
$request = Request::getCurrentRequest();
try {
    $dispatcher = Dispatcher::getCurrentDispatcher();
    $controllerClass = $dispatcher->dispatchController($request);
    $controller = new $controllerClass();
    $controller->execute($dispatcher->dispatchAction($request, $controller), $request);
} catch (HttpException $e) {
    $controller = new ExceptionHandlerController();
    $controller->defaultAction($e);
}
    catch (Exception $e) {
    echo 'Error : ' . $e->getMessage() . "\n";
}
?>																																										
