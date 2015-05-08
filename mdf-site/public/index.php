<?php
error_reporting(E_ALL ^ E_NOTICE);

include '../../mdf/App.php';

$app = \MDF\App::getInstance();
$app->setRouter('DefaultRouter');
$app->run();


// Test session
$s = $app->getSession();
$s->count+=1;
echo $s->count;

// DB test
//$db = new \MDF\DB\SimpleDB();
//$result = $db->prepare('SELECT * FROM users WHERE id=?', array(2))->execute()->fetchAllAssoc();
//var_dump($result);

//echo '<br>'. $_SERVER['DOCUMENT_ROOT'];