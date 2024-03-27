<?php
$databases['default']['default'] = [
'database' => getenv('MYSQL_DB'),
'username' => getenv('MYSQL_USER'),
'password' => getenv('MYSQL_PASSWORD'),
'host' => getenv('MYSQL_HOST'),
'port' => getenv('MYSQL_POST'),
'driver' => 'mysql',
'prefix' => ''
];
$settings['hash_salt'] = json_encode($databases);

ini_set('xdebug.max_nesting_level', 500);
ini_set('memory_limit', '128M');
ini_set('max_execution_time', 120);
