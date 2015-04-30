<?php
error_reporting(E_ALL ^ E_NOTICE);

include '../../mdf/App.php';

$app = \MDF\App::getInstance();

$app->run();

// Test getting config file
//echo $app->getConfig()->app;