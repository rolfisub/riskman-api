<?php
return array(
    'db' => array(
        'adapters' => array(
            'db1' => array(
                'database' => 'riskman',
                'driver' => 'Mysqli',
                'hostname' => '192.168.1.53',
                'username' => 'riskman',
                'password' => 'lXytl3kAvDCXMzFg',
                'port' => '3306',
            ),
        ),
    ),
    'doctrine' => array(
        'connection' => array(
            'orm_default' => array(
                'driverClass' => 'Doctrine\DBAL\Driver\PDOMySql\Driver',
                'params' => array(
                    'host'     => '192.168.1.53',
                    'port'     => '3306',
                    'user'     => 'riskman',
                    'password' => 'lXytl3kAvDCXMzFg',
                    'dbname'   => 'riskman',
                )
            )
        )
    ),
);
