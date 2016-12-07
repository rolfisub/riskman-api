<?php
return array(
    'service_manager' => array(
        'factories' => array(
            'RiskMan\\V1\\Rest\\Sport\\SportResource' => 'RiskMan\\V1\\Rest\\Sport\\SportResourceFactory',
        ),
    ),
    'router' => array(
        'routes' => array(
            'risk-man.rest.sport' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/sport[/:sport_id]',
                    'defaults' => array(
                        'controller' => 'RiskMan\\V1\\Rest\\Sport\\Controller',
                    ),
                ),
            ),
        ),
    ),
    'zf-versioning' => array(
        'uri' => array(
            0 => 'risk-man.rest.sport',
        ),
    ),
    'zf-rest' => array(
        'RiskMan\\V1\\Rest\\Sport\\Controller' => array(
            'listener' => 'RiskMan\\V1\\Rest\\Sport\\SportResource',
            'route_name' => 'risk-man.rest.sport',
            'route_identifier_name' => 'sport_id',
            'collection_name' => 'sport',
            'entity_http_methods' => array(
                0 => 'GET',
                1 => 'PATCH',
                2 => 'PUT',
                3 => 'DELETE',
            ),
            'collection_http_methods' => array(
                0 => 'GET',
                1 => 'POST',
            ),
            'collection_query_whitelist' => array(),
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => 'RiskMan\\V1\\Rest\\Sport\\SportEntity',
            'collection_class' => 'RiskMan\\V1\\Rest\\Sport\\SportCollection',
            'service_name' => 'Sport',
        ),
    ),
    'zf-content-negotiation' => array(
        'controllers' => array(
            'RiskMan\\V1\\Rest\\Sport\\Controller' => 'HalJson',
        ),
        'accept_whitelist' => array(
            'RiskMan\\V1\\Rest\\Sport\\Controller' => array(
                0 => 'application/vnd.risk-man.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ),
        ),
        'content_type_whitelist' => array(
            'RiskMan\\V1\\Rest\\Sport\\Controller' => array(
                0 => 'application/vnd.risk-man.v1+json',
                1 => 'application/json',
            ),
        ),
    ),
    'zf-hal' => array(
        'metadata_map' => array(
            'RiskMan\\V1\\Rest\\Sport\\SportEntity' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'risk-man.rest.sport',
                'route_identifier_name' => 'sport_id',
                'hydrator' => 'Zend\\Hydrator\\ArraySerializable',
            ),
            'RiskMan\\V1\\Rest\\Sport\\SportCollection' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'risk-man.rest.sport',
                'route_identifier_name' => 'sport_id',
                'is_collection' => true,
            ),
        ),
    ),
);
