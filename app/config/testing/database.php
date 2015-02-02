<?php
return array(
    'default' => 'testing',
    'connections' => array(
        'sqlite' => array(
            'driver' => 'sqlite',
            'host' => 'localhost',
            'database' => ':memory:',
            'prefix' => ''
        ),
        'mysql' => array(
            'driver' => 'mysql',
            'host' => getenv('DB_HOST'),
            'database' => getenv('DB_NAME'),
            'username' => getenv('DB_USERNAME'),
            'password' => getenv('DB_USERPASSWORD'),
            'charset' => 'utf8',
            'collation' => 'utf8_general_ci',
            'prefix' => ''
        ),
        'testing' => array(
            'driver' => 'mysql',
            'host' => getenv('DB_HOST'),
            'database' => getenv('DB_NAME'),
            'username' => getenv('DB_USERNAME'),
            'password' => getenv('DB_USERPASSWORD'),
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix' => ''
        )
    )
);