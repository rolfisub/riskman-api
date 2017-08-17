<?php
return array(
    'db' => array(
        'adapters' => array(
            'db1' => array(),
        ),
    ),
    'router' => array(
        'routes' => array(
            'oauth' => array(
                'options' => array(
                    'spec' => '%oauth%',
                    'regex' => '(?P<oauth>(/oauth))',
                ),
                'type' => 'regex',
            ),
        ),
    ),
    'zf-mvc-auth' => array(
        'authentication' => array(
            'map' => array(
                'RiskMan\\V1' => 'oauth2riskman',
            ),
        ),
    ),
);
