<?php
$databases['default']['default'] = [
'database' => getenv('MYSQL_DB'),
'username' => getenv('MYSQL_USER'),
'password' => getenv('MYSQL_PASSWORD'),
'host' => getenv('POSTGRES_HOST'),
'port' => getenv('POSTGRES_POST'),
'driver' => 'pgsql',
'prefix' => '',
'namespace' => 'Drupal\\Core\\Database\\Driver\\pgsql',
'autoload' => 'core/modules/pgsql/src/Driver/Database/pgsql/',
];
$settings['hash_salt'] = json_encode($databases);


ini_set('xdebug.max_nesting_level', 500);
ini_set('memory_limit', '128M');
ini_set('max_execution_time', 120);

$config['system.logging']['error_level']='verbose';
