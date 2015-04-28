<?php
error_reporting(E_ALL ^ E_NOTICE);

include '../../mdf/App.php';

$app = \MDF\App::getInstance();
//$app->run();
// Test file autoload
//new \MDF\Test();

// Test setConfigFolder
$config = \MDF\Config::getInstance();
$config->setConfigFolder('../config');

$config->app;