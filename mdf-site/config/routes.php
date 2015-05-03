<?php
$cnf['admin']['namespace'] = 'Controllers\Admin';
$cnf['administration']['namespace'] = 'Controllers\Admin';

// Provide the possibility to detach the names of the controllers from the provided params in the uri
$cnf['administration']['controllers']['index']['to'] = 'index';
$cnf['administration']['controllers']['index']['methods']['user'] = 'profile';

$cnf['administration']['controllers']['new']['to'] = 'create';
//Default situation -> URI '/'
$cnf['*']['namespace'] = 'Controllers';
return $cnf;