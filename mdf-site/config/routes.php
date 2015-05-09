<?php
$cnf['admin']['namespace'] = 'Controllers\Admin';
$cnf['administration']['namespace'] = 'Controllers\Admin';
$cnf['user']['namespace'] = 'Controllers\User';

// Provide the possibility to detach the names of the controllers from the provided params in the uri
$cnf['administration']['controllers']['index']['to'] = 'index';
$cnf['administration']['controllers']['index']['methods']['user'] = 'profile';

$cnf['administration']['controllers']['new']['to'] = 'create';
//Default situation -> URI '/'
$cnf['*']['namespace'] = 'Controllers';
$cnf['*']['controllers']['posts']['index']['to'] = 'index';
$cnf['*']['controllers']['posts']['methods']['view'] = 'view';

$cnf['user']['controllers']['index']['to'] = 'index';
$cnf['user']['controllers']['index']['methods']['add-post'] = 'addPost';
$cnf['user']['controllers']['index']['methods']['new'] = 'addNewPost';
return $cnf;