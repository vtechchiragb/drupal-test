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
