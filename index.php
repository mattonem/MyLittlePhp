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
require_once(__ROOT_DIR . '/lib/addendum/annotations.php');
require_once(__ROOT_DIR . '/lib/php-activerecord/ActiveRecord.php');
require_once(__ROOT_DIR . '/lib/Michelf/Markdown.inc.php');
require_once(__ROOT_DIR . '/lib/Michelf/MarkdownExtra.inc.php');
require_once(__ROOT_DIR . '/classes/AutoLoader.php');
// Connect database
ActiveRecord\Config::initialize(function($cfg) {
$cfg->set_model_directory(__DIR__ . '/model');
$cfg->set_connections(array('development' => 'mysql://mylittlephp:mylittlephp@127.0.0.1/mylittlephp'));
$cfg->set_default_connection('development');
});

session_start();

// Reify the current request
$request = Request::getCurrentRequest();
try {
$dispatcher = Dispatcher::getCurrentDispatcher();
$controller = $dispatcher->dispatchController($request);
$controller->execute($dispatcher->dispatchAction($request, $controller));
} catch (MyHttpException $e) {
$controller = new ExceptionHandlerController();
$controller->defaultAction($e);
} catch (Exception $e) {
echo 'Error : ' . $e->getMessage() . "\n";
}																																										
