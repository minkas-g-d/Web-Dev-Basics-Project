<?php
error_reporting(E_ALL ^ E_NOTICE);

include '../../mdf/App.php';

date_default_timezone_set('Europe/Sofia');

$app = \MDF\App::getInstance();
$app->setRouter('DefaultRouter');
$app->run();

//echo date_default_timezone_get();
//echo '<br>';
//echo date('m/d/Y h:i:s a', time());


// Test session
//$s = $app->getSession();
//$s->count+=1;
//echo $s->count;

// DB test
//$db = new \MDF\DB\SimpleDB();
//$result = $db->prepare('SELECT * FROM users WHERE id=?', array(2))->execute()->fetchAllAssoc();
//var_dump($result);

//echo '<br>'. $_SERVER['DOCUMENT_ROOT'];