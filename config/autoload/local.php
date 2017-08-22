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
    'zf-mvc-auth' => array(
        'authentication' => array(
            'adapters' => array(
                'oauth2riskman' => array(
                    'adapter' => 'ZF\\MvcAuth\\Authentication\\OAuth2Adapter',
                    'storage' => array(
                        'adapter' => 'pdo',
                        'dsn' => 'mysql:host=192.168.1.53;dbname=riskman',
                        'route' => '/oauth',
                        'username' => 'oauth2User',
                        'password' => 'KxTeeZE2kZLoCkBb',
                    ),
                ),
            ),
        ),
    ),
);
