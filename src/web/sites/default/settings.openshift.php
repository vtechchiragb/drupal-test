<?php
$databases['default']['default'] = [
'database' => getenv('POSTGRES_DB'),
'username' => getenv('POSTGRES_USER'),
'password' => getenv('POSTGRES_PASSWORD'),
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
