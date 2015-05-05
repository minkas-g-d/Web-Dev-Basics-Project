<?php

$cnf['default']['connection_string'] = 'mysql:host=localhost;dbname=mvc';
$cnf['default']['username'] = 'root';
$cnf['default']['password'] = 'root';
$cnf['default']['pdo_options'][PDO::MYSQL_ATTR_INIT_COMMAND] = "SET NAMES 'UTF8'";
$cnf['default']['pdo_options'][PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;

return $cnf;