<?php
error_reporting(E_ALL ^ E_NOTICE);

include '../../mdf/App.php';

date_default_timezone_set('Europe/Sofia');

$app = \MDF\App::getInstance();
$app->setRouter('DefaultRouter');
$app->run();