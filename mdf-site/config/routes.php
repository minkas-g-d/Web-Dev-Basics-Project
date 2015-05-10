<?php
$cnf['admin']['namespace'] = 'Controllers\Admin';
$cnf['administration']['namespace'] = 'Controllers\Admin';
//$cnf['user']['namespace'] = 'Controllers\User';
//$cnf['user']['controllers']['index']['to'] = 'index';
//$cnf['user']['controllers']['index']['methods']['add-post'] = 'addPost';
//$cnf['user']['controllers']['index']['methods']['new'] = 'addNewPost';

// Provide the possibility to detach the names of the controllers from the provided params in the uri
$cnf['administration']['controllers']['index']['to'] = 'index';
$cnf['administration']['controllers']['index']['methods']['user'] = 'profile';

$cnf['administration']['controllers']['new']['to'] = 'create';

//Default situation -> URI '/'
$cnf['*']['namespace'] = 'Controllers';

$cnf['*']['controllers']['posts']['index']['to'] = 'index';
$cnf['*']['controllers']['posts']['methods']['view'] = 'view';

$cnf['*']['controllers']['user']['index']['to'] = 'index';
$cnf['*']['controllers']['user']['methods']['add-post'] = 'renderAddPost';
$cnf['*']['controllers']['user']['methods']['new-post'] = 'addPost';


$cnf['*']['controllers']['user']['methods']['register'] = 'renderRegister';
$cnf['*']['controllers']['user']['methods']['new'] = 'register';

$cnf['*']['controllers']['user']['methods']['login'] = 'renderLogin';
$cnf['*']['controllers']['user']['methods']['signin'] = 'renderLogin';

return $cnf;