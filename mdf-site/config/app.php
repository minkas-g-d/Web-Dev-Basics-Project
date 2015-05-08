<?php

$cnf['default_controller'] = 'Index';
$cnf['default_method'] = 'index';
$cnf['namespaces']['Controllers'] = 'C:/xampp/htdocs/web-dev-basics-project/mdf-site/controllers/';

$cnf['session']['autostart'] = true;
$cnf['session']['type'] = 'native';
$cnf['session']['name'] = '__sess';
$cnf['session']['lifetime'] = 3600;
$cnf['session']['path'] = '/';
// session available for all domains
$cnf['session']['domain'] = '';
$cnf['session']['security'] = false;

$cnf['displayExceptions'] = true;

return $cnf;