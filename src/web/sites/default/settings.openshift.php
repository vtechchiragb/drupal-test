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
