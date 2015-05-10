<?php
//$cnf['user']['namespace'] = 'Controllers\User';
//$cnf['user']['controllers']['index']['to'] = 'index';
//$cnf['user']['controllers']['index']['methods']['add-post'] = 'addPost';
//$cnf['user']['controllers']['index']['methods']['new'] = 'addNewPost';

//Default situation -> URI '/'
$cnf['*']['namespace'] = 'Controllers';

$cnf['*']['controllers']['posts']['index']['to'] = 'index';
$cnf['*']['controllers']['posts']['methods']['view'] = 'view';

$cnf['*']['controllers']['user']['index']['to'] = 'index';
$cnf['*']['controllers']['user']['methods']['add-post'] = 'renderAddPost';
$cnf['*']['controllers']['user']['methods']['new-post'] = 'addPost';
$cnf['*']['controllers']['user']['methods']['delete-post'] = 'deletePost';

$cnf['*']['controllers']['user']['methods']['register'] = 'renderRegister';
$cnf['*']['controllers']['user']['methods']['new'] = 'register';

$cnf['*']['controllers']['user']['methods']['login'] = 'renderLogin';
$cnf['*']['controllers']['user']['methods']['signin'] = 'login';

return $cnf;