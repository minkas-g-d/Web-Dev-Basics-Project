<?php
error_reporting(E_ALL ^ E_NOTICE);

include '../../mdf/App.php';

$app = \MDF\App::getInstance();
$app->setRouter('DefaultRouter');
$app->run();

//echo '<br>'. $_SERVER['DOCUMENT_ROOT'];