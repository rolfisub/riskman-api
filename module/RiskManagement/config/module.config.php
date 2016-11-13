<?php
return [
    'service_manager' => [
        'factories' => [
            \RiskManagement\V1\Rest\Sport\SportResource::class => \RiskManagement\V1\Rest\Sport\SportResourceFactory::class,
            \RiskManagement\V1\Rest\Region\RegionResource::class => \RiskManagement\V1\Rest\Region\RegionResourceFactory::class,
            \RiskManagement\V1\Rest\League\LeagueResource::class => \RiskManagement\V1\Rest\League\LeagueResourceFactory::class,
            \RiskManagement\V1\Rest\Event\EventResource::class => \RiskManagement\V1\Rest\Event\EventResourceFactory::class,
            \RiskManagement\V1\Rest\Odd\OddResource::class => \RiskManagement\V1\Rest\Odd\OddResourceFactory::class,
            \RiskManagement\V1\Rest\OddSelection\OddSelectionResource::class => \RiskManagement\V1\Rest\OddSelection\OddSelectionResourceFactory::class,
            \RiskManagement\V1\Rest\Player\PlayerResource::class => \RiskManagement\V1\Rest\Player\PlayerResourceFactory::class,
            \RiskManagement\V1\Rest\Single\SingleResource::class => \RiskManagement\V1\Rest\Single\SingleResourceFactory::class,
            \RiskManagement\V1\Rest\Multiple\MultipleResource::class => \RiskManagement\V1\Rest\Multiple\MultipleResourceFactory::class,
            \RiskManagement\V1\Rest\MultipleSelection\MultipleSelectionResource::class => \RiskManagement\V1\Rest\MultipleSelection\MultipleSelectionResourceFactory::class,
        ],
    ],
    'router' => [
        'routes' => [
            'risk-management.rest.sport' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/sport[/:sport_id]',
                    'defaults' => [
                        'controller' => 'RiskManagement\\V1\\Rest\\Sport\\Controller',
                    ],
                ],
            ],
            'risk-management.rest.region' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/region[/:region_id]',
                    'defaults' => [
                        'controller' => 'RiskManagement\\V1\\Rest\\Region\\Controller',
                    ],
                ],
            ],
            'risk-management.rest.league' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/league[/:league_id]',
                    'defaults' => [
                        'controller' => 'RiskManagement\\V1\\Rest\\League\\Controller',
                    ],
                ],
            ],
            'risk-management.rest.event' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/event[/:event_id]',
                    'defaults' => [
                        'controller' => 'RiskManagement\\V1\\Rest\\Event\\Controller',
                    ],
                ],
            ],
            'risk-management.rest.odd' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/odd[/:odd_id]',
                    'defaults' => [
                        'controller' => 'RiskManagement\\V1\\Rest\\Odd\\Controller',
                    ],
                ],
            ],
            'risk-management.rest.odd-selection' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/odd-selection[/:odd_selection_id]',
                    'defaults' => [
                        'controller' => 'RiskManagement\\V1\\Rest\\OddSelection\\Controller',
                    ],
                ],
            ],
            'risk-management.rest.player' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/player[/:player_id]',
                    'defaults' => [
                        'controller' => 'RiskManagement\\V1\\Rest\\Player\\Controller',
                    ],
                ],
            ],
            'risk-management.rest.single' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/single[/:single_id]',
                    'defaults' => [
                        'controller' => 'RiskManagement\\V1\\Rest\\Single\\Controller',
                    ],
                ],
            ],
            'risk-management.rest.multiple' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/multiple[/:multiple_id]',
                    'defaults' => [
                        'controller' => 'RiskManagement\\V1\\Rest\\Multiple\\Controller',
                    ],
                ],
            ],
            'risk-management.rest.multiple-selection' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/multiple-selection[/:multiple_selection_id]',
                    'defaults' => [
                        'controller' => 'RiskManagement\\V1\\Rest\\MultipleSelection\\Controller',
                    ],
                ],
            ],
        ],
    ],
    'zf-versioning' => [
        'uri' => [
            0 => 'risk-management.rest.sport',
            1 => 'risk-management.rest.region',
            2 => 'risk-management.rest.league',
            3 => 'risk-management.rest.event',
            4 => 'risk-management.rest.odd',
            5 => 'risk-management.rest.odd-selection',
            6 => 'risk-management.rest.player',
            7 => 'risk-management.rest.single',
            8 => 'risk-management.rest.multiple',
            9 => 'risk-management.rest.multiple-selection',
        ],
    ],
    'zf-rest' => [
        'RiskManagement\\V1\\Rest\\Sport\\Controller' => [
            'listener' => \RiskManagement\V1\Rest\Sport\SportResource::class,
            'route_name' => 'risk-management.rest.sport',
            'route_identifier_name' => 'sport_id',
            'collection_name' => 'sport',
            'entity_http_methods' => [
                0 => 'GET',
                1 => 'PATCH',
                2 => 'PUT',
                3 => 'DELETE',
            ],
            'collection_http_methods' => [
                0 => 'GET',
                1 => 'POST',
            ],
            'collection_query_whitelist' => [],
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => \RiskManagement\V1\Rest\Sport\SportEntity::class,
            'collection_class' => \RiskManagement\V1\Rest\Sport\SportCollection::class,
            'service_name' => 'Sport',
        ],
        'RiskManagement\\V1\\Rest\\Region\\Controller' => [
            'listener' => \RiskManagement\V1\Rest\Region\RegionResource::class,
            'route_name' => 'risk-management.rest.region',
            'route_identifier_name' => 'region_id',
            'collection_name' => 'region',
            'entity_http_methods' => [
                0 => 'GET',
                1 => 'PATCH',
                2 => 'PUT',
                3 => 'DELETE',
            ],
            'collection_http_methods' => [
                0 => 'GET',
                1 => 'POST',
            ],
            'collection_query_whitelist' => [],
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => \RiskManagement\V1\Rest\Region\RegionEntity::class,
            'collection_class' => \RiskManagement\V1\Rest\Region\RegionCollection::class,
            'service_name' => 'Region',
        ],
        'RiskManagement\\V1\\Rest\\League\\Controller' => [
            'listener' => \RiskManagement\V1\Rest\League\LeagueResource::class,
            'route_name' => 'risk-management.rest.league',
            'route_identifier_name' => 'league_id',
            'collection_name' => 'league',
            'entity_http_methods' => [
                0 => 'GET',
                1 => 'PATCH',
                2 => 'PUT',
                3 => 'DELETE',
            ],
            'collection_http_methods' => [
                0 => 'GET',
                1 => 'POST',
            ],
            'collection_query_whitelist' => [],
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => \RiskManagement\V1\Rest\League\LeagueEntity::class,
            'collection_class' => \RiskManagement\V1\Rest\League\LeagueCollection::class,
            'service_name' => 'League',
        ],
        'RiskManagement\\V1\\Rest\\Event\\Controller' => [
            'listener' => \RiskManagement\V1\Rest\Event\EventResource::class,
            'route_name' => 'risk-management.rest.event',
            'route_identifier_name' => 'event_id',
            'collection_name' => 'event',
            'entity_http_methods' => [
                0 => 'GET',
                1 => 'PATCH',
                2 => 'PUT',
                3 => 'DELETE',
            ],
            'collection_http_methods' => [
                0 => 'GET',
                1 => 'POST',
            ],
            'collection_query_whitelist' => [],
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => \RiskManagement\V1\Rest\Event\EventEntity::class,
            'collection_class' => \RiskManagement\V1\Rest\Event\EventCollection::class,
            'service_name' => 'Event',
        ],
        'RiskManagement\\V1\\Rest\\Odd\\Controller' => [
            'listener' => \RiskManagement\V1\Rest\Odd\OddResource::class,
            'route_name' => 'risk-management.rest.odd',
            'route_identifier_name' => 'odd_id',
            'collection_name' => 'odd',
            'entity_http_methods' => [
                0 => 'GET',
                1 => 'PATCH',
                2 => 'PUT',
                3 => 'DELETE',
            ],
            'collection_http_methods' => [
                0 => 'GET',
                1 => 'POST',
            ],
            'collection_query_whitelist' => [],
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => \RiskManagement\V1\Rest\Odd\OddEntity::class,
            'collection_class' => \RiskManagement\V1\Rest\Odd\OddCollection::class,
            'service_name' => 'Odd',
        ],
        'RiskManagement\\V1\\Rest\\OddSelection\\Controller' => [
            'listener' => \RiskManagement\V1\Rest\OddSelection\OddSelectionResource::class,
            'route_name' => 'risk-management.rest.odd-selection',
            'route_identifier_name' => 'odd_selection_id',
            'collection_name' => 'odd_selection',
            'entity_http_methods' => [
                0 => 'GET',
                1 => 'PATCH',
                2 => 'PUT',
                3 => 'DELETE',
            ],
            'collection_http_methods' => [
                0 => 'GET',
                1 => 'POST',
            ],
            'collection_query_whitelist' => [],
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => \RiskManagement\V1\Rest\OddSelection\OddSelectionEntity::class,
            'collection_class' => \RiskManagement\V1\Rest\OddSelection\OddSelectionCollection::class,
            'service_name' => 'OddSelection',
        ],
        'RiskManagement\\V1\\Rest\\Player\\Controller' => [
            'listener' => \RiskManagement\V1\Rest\Player\PlayerResource::class,
            'route_name' => 'risk-management.rest.player',
            'route_identifier_name' => 'player_id',
            'collection_name' => 'player',
            'entity_http_methods' => [
                0 => 'GET',
                1 => 'PATCH',
                2 => 'PUT',
                3 => 'DELETE',
            ],
            'collection_http_methods' => [
                0 => 'GET',
                1 => 'POST',
            ],
            'collection_query_whitelist' => [],
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => \RiskManagement\V1\Rest\Player\PlayerEntity::class,
            'collection_class' => \RiskManagement\V1\Rest\Player\PlayerCollection::class,
            'service_name' => 'Player',
        ],
        'RiskManagement\\V1\\Rest\\Single\\Controller' => [
            'listener' => \RiskManagement\V1\Rest\Single\SingleResource::class,
            'route_name' => 'risk-management.rest.single',
            'route_identifier_name' => 'single_id',
            'collection_name' => 'single',
            'entity_http_methods' => [
                0 => 'GET',
                1 => 'PATCH',
                2 => 'PUT',
                3 => 'DELETE',
            ],
            'collection_http_methods' => [
                0 => 'GET',
                1 => 'POST',
            ],
            'collection_query_whitelist' => [],
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => \RiskManagement\V1\Rest\Single\SingleEntity::class,
            'collection_class' => \RiskManagement\V1\Rest\Single\SingleCollection::class,
            'service_name' => 'Single',
        ],
        'RiskManagement\\V1\\Rest\\Multiple\\Controller' => [
            'listener' => \RiskManagement\V1\Rest\Multiple\MultipleResource::class,
            'route_name' => 'risk-management.rest.multiple',
            'route_identifier_name' => 'multiple_id',
            'collection_name' => 'multiple',
            'entity_http_methods' => [
                0 => 'GET',
                1 => 'PATCH',
                2 => 'PUT',
                3 => 'DELETE',
            ],
            'collection_http_methods' => [
                0 => 'GET',
                1 => 'POST',
            ],
            'collection_query_whitelist' => [],
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => \RiskManagement\V1\Rest\Multiple\MultipleEntity::class,
            'collection_class' => \RiskManagement\V1\Rest\Multiple\MultipleCollection::class,
            'service_name' => 'Multiple',
        ],
        'RiskManagement\\V1\\Rest\\MultipleSelection\\Controller' => [
            'listener' => \RiskManagement\V1\Rest\MultipleSelection\MultipleSelectionResource::class,
            'route_name' => 'risk-management.rest.multiple-selection',
            'route_identifier_name' => 'multiple_selection_id',
            'collection_name' => 'multiple_selection',
            'entity_http_methods' => [
                0 => 'GET',
                1 => 'PATCH',
                2 => 'PUT',
                3 => 'DELETE',
            ],
            'collection_http_methods' => [
                0 => 'GET',
                1 => 'POST',
            ],
            'collection_query_whitelist' => [],
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => \RiskManagement\V1\Rest\MultipleSelection\MultipleSelectionEntity::class,
            'collection_class' => \RiskManagement\V1\Rest\MultipleSelection\MultipleSelectionCollection::class,
            'service_name' => 'MultipleSelection',
        ],
    ],
    'zf-content-negotiation' => [
        'controllers' => [
            'RiskManagement\\V1\\Rest\\Sport\\Controller' => 'HalJson',
            'RiskManagement\\V1\\Rest\\Region\\Controller' => 'HalJson',
            'RiskManagement\\V1\\Rest\\League\\Controller' => 'HalJson',
            'RiskManagement\\V1\\Rest\\Event\\Controller' => 'HalJson',
            'RiskManagement\\V1\\Rest\\Odd\\Controller' => 'HalJson',
            'RiskManagement\\V1\\Rest\\OddSelection\\Controller' => 'HalJson',
            'RiskManagement\\V1\\Rest\\Player\\Controller' => 'HalJson',
            'RiskManagement\\V1\\Rest\\Single\\Controller' => 'HalJson',
            'RiskManagement\\V1\\Rest\\Multiple\\Controller' => 'HalJson',
            'RiskManagement\\V1\\Rest\\MultipleSelection\\Controller' => 'HalJson',
        ],
        'accept_whitelist' => [
            'RiskManagement\\V1\\Rest\\Sport\\Controller' => [
                0 => 'application/vnd.risk-management.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ],
            'RiskManagement\\V1\\Rest\\Region\\Controller' => [
                0 => 'application/vnd.risk-management.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ],
            'RiskManagement\\V1\\Rest\\League\\Controller' => [
                0 => 'application/vnd.risk-management.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ],
            'RiskManagement\\V1\\Rest\\Event\\Controller' => [
                0 => 'application/vnd.risk-management.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ],
            'RiskManagement\\V1\\Rest\\Odd\\Controller' => [
                0 => 'application/vnd.risk-management.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ],
            'RiskManagement\\V1\\Rest\\OddSelection\\Controller' => [
                0 => 'application/vnd.risk-management.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ],
            'RiskManagement\\V1\\Rest\\Player\\Controller' => [
                0 => 'application/vnd.risk-management.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ],
            'RiskManagement\\V1\\Rest\\Single\\Controller' => [
                0 => 'application/vnd.risk-management.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ],
            'RiskManagement\\V1\\Rest\\Multiple\\Controller' => [
                0 => 'application/vnd.risk-management.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ],
            'RiskManagement\\V1\\Rest\\MultipleSelection\\Controller' => [
                0 => 'application/vnd.risk-management.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ],
        ],
        'content_type_whitelist' => [
            'RiskManagement\\V1\\Rest\\Sport\\Controller' => [
                0 => 'application/vnd.risk-management.v1+json',
                1 => 'application/json',
            ],
            'RiskManagement\\V1\\Rest\\Region\\Controller' => [
                0 => 'application/vnd.risk-management.v1+json',
                1 => 'application/json',
            ],
            'RiskManagement\\V1\\Rest\\League\\Controller' => [
                0 => 'application/vnd.risk-management.v1+json',
                1 => 'application/json',
            ],
            'RiskManagement\\V1\\Rest\\Event\\Controller' => [
                0 => 'application/vnd.risk-management.v1+json',
                1 => 'application/json',
            ],
            'RiskManagement\\V1\\Rest\\Odd\\Controller' => [
                0 => 'application/vnd.risk-management.v1+json',
                1 => 'application/json',
            ],
            'RiskManagement\\V1\\Rest\\OddSelection\\Controller' => [
                0 => 'application/vnd.risk-management.v1+json',
                1 => 'application/json',
            ],
            'RiskManagement\\V1\\Rest\\Player\\Controller' => [
                0 => 'application/vnd.risk-management.v1+json',
                1 => 'application/json',
            ],
            'RiskManagement\\V1\\Rest\\Single\\Controller' => [
                0 => 'application/vnd.risk-management.v1+json',
                1 => 'application/json',
            ],
            'RiskManagement\\V1\\Rest\\Multiple\\Controller' => [
                0 => 'application/vnd.risk-management.v1+json',
                1 => 'application/json',
            ],
            'RiskManagement\\V1\\Rest\\MultipleSelection\\Controller' => [
                0 => 'application/vnd.risk-management.v1+json',
                1 => 'application/json',
            ],
        ],
    ],
    'zf-hal' => [
        'metadata_map' => [
            \RiskManagement\V1\Rest\Sport\SportEntity::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'risk-management.rest.sport',
                'route_identifier_name' => 'sport_id',
                'hydrator' => \Zend\Hydrator\ArraySerializable::class,
            ],
            \RiskManagement\V1\Rest\Sport\SportCollection::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'risk-management.rest.sport',
                'route_identifier_name' => 'sport_id',
                'is_collection' => true,
            ],
            \RiskManagement\V1\Rest\Region\RegionEntity::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'risk-management.rest.region',
                'route_identifier_name' => 'region_id',
                'hydrator' => \Zend\Hydrator\ArraySerializable::class,
            ],
            \RiskManagement\V1\Rest\Region\RegionCollection::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'risk-management.rest.region',
                'route_identifier_name' => 'region_id',
                'is_collection' => true,
            ],
            \RiskManagement\V1\Rest\League\LeagueEntity::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'risk-management.rest.league',
                'route_identifier_name' => 'league_id',
                'hydrator' => \Zend\Hydrator\ArraySerializable::class,
            ],
            \RiskManagement\V1\Rest\League\LeagueCollection::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'risk-management.rest.league',
                'route_identifier_name' => 'league_id',
                'is_collection' => true,
            ],
            \RiskManagement\V1\Rest\Event\EventEntity::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'risk-management.rest.event',
                'route_identifier_name' => 'event_id',
                'hydrator' => \Zend\Hydrator\ArraySerializable::class,
            ],
            \RiskManagement\V1\Rest\Event\EventCollection::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'risk-management.rest.event',
                'route_identifier_name' => 'event_id',
                'is_collection' => true,
            ],
            \RiskManagement\V1\Rest\Odd\OddEntity::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'risk-management.rest.odd',
                'route_identifier_name' => 'odd_id',
                'hydrator' => \Zend\Hydrator\ArraySerializable::class,
            ],
            \RiskManagement\V1\Rest\Odd\OddCollection::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'risk-management.rest.odd',
                'route_identifier_name' => 'odd_id',
                'is_collection' => true,
            ],
            \RiskManagement\V1\Rest\OddSelection\OddSelectionEntity::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'risk-management.rest.odd-selection',
                'route_identifier_name' => 'odd_selection_id',
                'hydrator' => \Zend\Hydrator\ArraySerializable::class,
            ],
            \RiskManagement\V1\Rest\OddSelection\OddSelectionCollection::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'risk-management.rest.odd-selection',
                'route_identifier_name' => 'odd_selection_id',
                'is_collection' => true,
            ],
            \RiskManagement\V1\Rest\Player\PlayerEntity::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'risk-management.rest.player',
                'route_identifier_name' => 'player_id',
                'hydrator' => \Zend\Hydrator\ArraySerializable::class,
            ],
            \RiskManagement\V1\Rest\Player\PlayerCollection::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'risk-management.rest.player',
                'route_identifier_name' => 'player_id',
                'is_collection' => true,
            ],
            \RiskManagement\V1\Rest\Single\SingleEntity::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'risk-management.rest.single',
                'route_identifier_name' => 'single_id',
                'hydrator' => \Zend\Hydrator\ArraySerializable::class,
            ],
            \RiskManagement\V1\Rest\Single\SingleCollection::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'risk-management.rest.single',
                'route_identifier_name' => 'single_id',
                'is_collection' => true,
            ],
            \RiskManagement\V1\Rest\Multiple\MultipleEntity::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'risk-management.rest.multiple',
                'route_identifier_name' => 'multiple_id',
                'hydrator' => \Zend\Hydrator\ArraySerializable::class,
            ],
            \RiskManagement\V1\Rest\Multiple\MultipleCollection::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'risk-management.rest.multiple',
                'route_identifier_name' => 'multiple_id',
                'is_collection' => true,
            ],
            \RiskManagement\V1\Rest\MultipleSelection\MultipleSelectionEntity::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'risk-management.rest.multiple-selection',
                'route_identifier_name' => 'multiple_selection_id',
                'hydrator' => \Zend\Hydrator\ArraySerializable::class,
            ],
            \RiskManagement\V1\Rest\MultipleSelection\MultipleSelectionCollection::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'risk-management.rest.multiple-selection',
                'route_identifier_name' => 'multiple_selection_id',
                'is_collection' => true,
            ],
        ],
    ],
    'zf-content-validation' => [
        'RiskManagement\\V1\\Rest\\Sport\\Controller' => [
            'input_filter' => 'RiskManagement\\V1\\Rest\\Sport\\Validator',
        ],
        'RiskManagement\\V1\\Rest\\Region\\Controller' => [
            'input_filter' => 'RiskManagement\\V1\\Rest\\Region\\Validator',
        ],
        'RiskManagement\\V1\\Rest\\League\\Controller' => [
            'input_filter' => 'RiskManagement\\V1\\Rest\\League\\Validator',
        ],
        'RiskManagement\\V1\\Rest\\Event\\Controller' => [
            'input_filter' => 'RiskManagement\\V1\\Rest\\Event\\Validator',
        ],
        'RiskManagement\\V1\\Rest\\Odd\\Controller' => [
            'input_filter' => 'RiskManagement\\V1\\Rest\\Odd\\Validator',
        ],
        'RiskManagement\\V1\\Rest\\OddSelection\\Controller' => [
            'input_filter' => 'RiskManagement\\V1\\Rest\\OddSelection\\Validator',
        ],
        'RiskManagement\\V1\\Rest\\Player\\Controller' => [
            'input_filter' => 'RiskManagement\\V1\\Rest\\Player\\Validator',
        ],
        'RiskManagement\\V1\\Rest\\Single\\Controller' => [
            'input_filter' => 'RiskManagement\\V1\\Rest\\Single\\Validator',
        ],
        'RiskManagement\\V1\\Rest\\Multiple\\Controller' => [
            'input_filter' => 'RiskManagement\\V1\\Rest\\Multiple\\Validator',
        ],
        'RiskManagement\\V1\\Rest\\MultipleSelection\\Controller' => [
            'input_filter' => 'RiskManagement\\V1\\Rest\\MultipleSelection\\Validator',
        ],
    ],
    'input_filter_specs' => [
        'RiskManagement\\V1\\Rest\\Sport\\Validator' => [
            0 => [
                'required' => true,
                'validators' => [
                    0 => [
                        'name' => \Zend\I18n\Validator\Alnum::class,
                        'options' => [],
                    ],
                    1 => [
                        'name' => \Zend\Validator\StringLength::class,
                        'options' => [
                            'max' => '32',
                            'min' => '1',
                        ],
                    ],
                ],
                'filters' => [],
                'name' => 'sport_id',
                'description' => 'Alpha Numeric only, Max 32 Char, Unique id with in the existing sports',
                'field_type' => 'string',
            ],
            1 => [
                'required' => false,
                'validators' => [
                    0 => [
                        'name' => \Zend\Validator\StringLength::class,
                        'options' => [
                            'min' => '1',
                            'max' => '64',
                        ],
                    ],
                ],
                'filters' => [],
                'name' => 'name',
                'field_type' => 'Varchar(64)',
                'continue_if_empty' => false,
            ],
        ],
        'RiskManagement\\V1\\Rest\\Region\\Validator' => [
            0 => [
                'required' => true,
                'validators' => [
                    0 => [
                        'name' => \Zend\I18n\Validator\Alnum::class,
                        'options' => [],
                    ],
                    1 => [
                        'name' => \Zend\Validator\StringLength::class,
                        'options' => [
                            'min' => '1',
                            'max' => '32',
                        ],
                    ],
                ],
                'filters' => [],
                'name' => 'region_id',
                'description' => 'Alpha Numeric only, Max 32 Char, Unique id with in the existing regions',
                'field_type' => 'Varchar(32)',
            ],
            1 => [
                'required' => false,
                'validators' => [
                    0 => [
                        'name' => \Zend\Validator\StringLength::class,
                        'options' => [
                            'max' => '64',
                            'min' => '1',
                        ],
                    ],
                ],
                'filters' => [],
                'name' => 'name',
                'description' => 'name of the region',
                'field_type' => 'Varchar(64)',
            ],
        ],
        'RiskManagement\\V1\\Rest\\League\\Validator' => [
            0 => [
                'required' => true,
                'validators' => [
                    0 => [
                        'name' => \Zend\I18n\Validator\Alnum::class,
                        'options' => [],
                    ],
                    1 => [
                        'name' => \Zend\Validator\StringLength::class,
                        'options' => [
                            'max' => '32',
                            'min' => '1',
                        ],
                    ],
                ],
                'filters' => [],
                'name' => 'league_id',
                'description' => 'Alpha Numeric only, Max 32 Char, Unique id with in the existing leagues',
                'field_type' => 'Varchar(32)',
            ],
            1 => [
                'required' => false,
                'validators' => [
                    0 => [
                        'name' => \Zend\Validator\StringLength::class,
                        'options' => [
                            'max' => '64',
                            'min' => '1',
                        ],
                    ],
                ],
                'filters' => [],
                'name' => 'name',
                'description' => 'name of league / tournament',
                'field_type' => 'Varchar(64)',
            ],
        ],
        'RiskManagement\\V1\\Rest\\Event\\Validator' => [
            0 => [
                'required' => true,
                'validators' => [
                    0 => [
                        'name' => \Zend\I18n\Validator\Alnum::class,
                        'options' => [],
                    ],
                    1 => [
                        'name' => \Zend\Validator\StringLength::class,
                        'options' => [
                            'max' => '32',
                            'min' => '1',
                        ],
                    ],
                ],
                'filters' => [],
                'name' => 'event_id',
                'description' => 'Alpha Numeric only, Max 32 Char, Unique id with in the existing events',
                'field_type' => 'Varchar(32)',
            ],
            1 => [
                'required' => false,
                'validators' => [
                    0 => [
                        'name' => \Zend\Validator\StringLength::class,
                        'options' => [
                            'max' => '64',
                            'min' => '1',
                        ],
                    ],
                ],
                'filters' => [],
                'name' => 'name',
                'description' => 'name of the event',
                'field_type' => 'Varchar(64)',
            ],
            2 => [
                'required' => true,
                'validators' => [
                    0 => [
                        'name' => \Zend\I18n\Validator\DateTime::class,
                        'options' => [],
                    ],
                ],
                'filters' => [
                    0 => [
                        'name' => \Zend\Filter\DateTimeFormatter::class,
                        'options' => [
                            'format' => 'Y-m-d H:i:s',
                        ],
                    ],
                ],
                'name' => 'start_time',
                'description' => 'Options are:
1. unix timestamp
2. formatted string example "tomorrow" or "2016-09-16 9pm"',
                'field_type' => 'Varchar(32)',
            ],
            3 => [
                'required' => false,
                'validators' => [
                    0 => [
                        'name' => \Zend\I18n\Validator\Alnum::class,
                        'options' => [],
                    ],
                    1 => [
                        'name' => \Zend\Validator\StringLength::class,
                        'options' => [
                            'max' => '32',
                            'min' => '1',
                        ],
                    ],
                ],
                'filters' => [],
                'name' => 'sport_id',
                'description' => 'Existing ID or New ID to create if not found',
                'field_type' => 'Varchar(32)',
            ],
            4 => [
                'required' => false,
                'validators' => [
                    0 => [
                        'name' => \Zend\Validator\StringLength::class,
                        'options' => [
                            'max' => '64',
                            'min' => '1',
                        ],
                    ],
                ],
                'filters' => [],
                'name' => 'sport_name',
                'description' => 'sport_name if creating a new one or updating an existing one',
                'field_type' => 'Varchar(64)',
            ],
            5 => [
                'required' => false,
                'validators' => [
                    0 => [
                        'name' => \Zend\I18n\Validator\Alnum::class,
                        'options' => [],
                    ],
                    1 => [
                        'name' => \Zend\Validator\StringLength::class,
                        'options' => [
                            'max' => '32',
                            'min' => '1',
                        ],
                    ],
                ],
                'filters' => [],
                'name' => 'region_id',
                'description' => 'Existing ID or New ID to create if not found',
                'field_type' => 'Varchar(32)',
            ],
            6 => [
                'required' => false,
                'validators' => [
                    0 => [
                        'name' => \Zend\Validator\StringLength::class,
                        'options' => [
                            'max' => '64',
                            'min' => '1',
                        ],
                    ],
                ],
                'filters' => [],
                'name' => 'region_name',
                'description' => 'region_name if creating a new one or updating an existing one',
                'field_type' => 'Varchar(64)',
            ],
            7 => [
                'required' => false,
                'validators' => [
                    0 => [
                        'name' => \Zend\I18n\Validator\Alnum::class,
                        'options' => [],
                    ],
                    1 => [
                        'name' => \Zend\Validator\StringLength::class,
                        'options' => [
                            'max' => '32',
                            'min' => '1',
                        ],
                    ],
                ],
                'filters' => [],
                'name' => 'league_id',
                'description' => 'Existing ID or New ID to create if not found',
                'field_type' => 'Varchar(32)',
            ],
            8 => [
                'required' => false,
                'validators' => [
                    0 => [
                        'name' => \Zend\Validator\StringLength::class,
                        'options' => [
                            'max' => '64',
                            'min' => '1',
                        ],
                    ],
                ],
                'filters' => [],
                'name' => 'league_name',
                'description' => 'league_name if creating a new one or updating an existing one',
                'field_type' => 'Varchar(64)',
            ],
        ],
        'RiskManagement\\V1\\Rest\\Odd\\Validator' => [
            0 => [
                'required' => true,
                'validators' => [
                    0 => [
                        'name' => \Zend\Validator\StringLength::class,
                        'options' => [
                            'max' => '32',
                            'min' => '1',
                        ],
                    ],
                ],
                'filters' => [],
                'name' => 'odd_id',
                'description' => 'Alpha Numeric only, Max 32 Char, Unique id with in the existing odds',
                'field_type' => 'Varchar(32)',
            ],
            1 => [
                'required' => false,
                'validators' => [
                    0 => [
                        'name' => \Zend\Validator\StringLength::class,
                        'options' => [
                            'max' => '64',
                            'min' => '1',
                        ],
                    ],
                ],
                'filters' => [],
                'name' => 'name',
                'description' => 'Odd name',
                'field_type' => 'Varchar(64)',
            ],
            2 => [
                'required' => false,
                'validators' => [
                    0 => [
                        'name' => \Zend\I18n\Validator\DateTime::class,
                        'options' => [],
                    ],
                ],
                'filters' => [
                    0 => [
                        'name' => \Zend\Filter\DateTimeFormatter::class,
                        'options' => [
                            'format' => 'Y-m-d H:i:s',
                        ],
                    ],
                ],
                'name' => 'odd_start_time',
                'description' => 'Odd start time, if none provided event start time assumed, if event_id doesn’t exists and odd_start_time not provided results in error',
                'field_type' => 'Varchar(32)',
            ],
            3 => [
                'required' => true,
                'validators' => [
                    0 => [
                        'name' => \Zend\Validator\StringLength::class,
                        'options' => [
                            'max' => '32',
                            'min' => '1',
                        ],
                    ],
                ],
                'filters' => [],
                'name' => 'event_id',
                'description' => 'Existing event_id to create an odd for',
                'field_type' => 'Varchar(32)',
            ],
            4 => [
                'required' => false,
                'validators' => [
                    0 => [
                        'name' => \Zend\Validator\StringLength::class,
                        'options' => [
                            'max' => '64',
                            'min' => '1',
                        ],
                    ],
                ],
                'filters' => [],
                'name' => 'event_name',
                'field_type' => 'Varchar(64)',
                'description' => 'event name to update or create',
            ],
            5 => [
                'required' => false,
                'validators' => [
                    0 => [
                        'name' => \Zend\I18n\Validator\DateTime::class,
                        'options' => [],
                    ],
                ],
                'filters' => [
                    0 => [
                        'name' => \Zend\Filter\DateTimeFormatter::class,
                        'options' => [
                            'format' => 'Y-m-d H:i:s',
                        ],
                    ],
                ],
                'name' => 'event_start_time',
                'description' => 'if creating a new event, it is required. If just assigning an eisting event then it is not required.',
                'field_type' => 'Varchar(32)',
            ],
            6 => [
                'required' => false,
                'validators' => [
                    0 => [
                        'name' => \Zend\Validator\Digits::class,
                        'options' => [],
                    ],
                    1 => [
                        'name' => \Zend\Validator\Between::class,
                        'options' => [
                            'max' => '1',
                            'min' => '0',
                            'inclusive' => true,
                        ],
                    ],
                ],
                'filters' => [],
                'name' => 'asian_handicap',
                'description' => 'notes if the odd should be handled as an asian handicap or not',
                'field_type' => 'int (0,1) or string (true false)',
            ],
        ],
        'RiskManagement\\V1\\Rest\\OddSelection\\Validator' => [
            0 => [
                'required' => true,
                'validators' => [
                    0 => [
                        'name' => \Zend\I18n\Validator\Alnum::class,
                        'options' => [],
                    ],
                    1 => [
                        'name' => \Zend\Validator\StringLength::class,
                        'options' => [
                            'max' => '32',
                            'min' => '1',
                        ],
                    ],
                ],
                'filters' => [],
                'name' => 'odd_selection_id',
                'description' => 'Alpha Numeric only, Max 32 Char, Unique id with in the existing oddselections',
                'field_type' => 'Varchar(32)',
            ],
            1 => [
                'required' => true,
                'validators' => [
                    0 => [
                        'name' => \Zend\Validator\StringLength::class,
                        'options' => [
                            'max' => '32',
                            'min' => '1',
                        ],
                    ],
                    1 => [
                        'name' => \Zend\I18n\Validator\Alnum::class,
                        'options' => [],
                    ],
                ],
                'filters' => [],
                'name' => 'odd_id',
                'description' => 'Existing odd_id to create an oddselection for',
                'field_type' => 'Varchar(32)',
            ],
            2 => [
                'required' => false,
                'validators' => [
                    0 => [
                        'name' => \Zend\Validator\StringLength::class,
                        'options' => [
                            'max' => '64',
                            'min' => '1',
                        ],
                    ],
                ],
                'filters' => [],
                'name' => 'selection_name',
                'description' => 'selection name or team name',
                'field_type' => 'Varchar(64)',
            ],
            3 => [
                'required' => false,
                'validators' => [
                    0 => [
                        'name' => \Zend\I18n\Validator\DateTime::class,
                        'options' => [],
                    ],
                ],
                'filters' => [
                    0 => [
                        'name' => \Zend\Filter\DateTimeFormatter::class,
                        'options' => [
                            'format' => 'Y-m-d H:i:s',
                        ],
                    ],
                ],
                'name' => 'odd_start_time',
                'description' => 'if creating a new odd is required, or if updating exisiting one then is not',
                'field_type' => 'Varchar(32)',
            ],
            4 => [
                'required' => false,
                'validators' => [
                    0 => [
                        'name' => \Zend\Validator\StringLength::class,
                        'options' => [
                            'max' => '32',
                            'min' => '1',
                        ],
                    ],
                    1 => [
                        'name' => \Zend\I18n\Validator\Alnum::class,
                        'options' => [],
                    ],
                ],
                'filters' => [],
                'name' => 'event_id',
                'description' => 'if new odd is created, event_id is required, if existing event id will update the other fields',
                'field_type' => 'Varchar(32)',
            ],
            5 => [
                'required' => false,
                'validators' => [
                    0 => [
                        'name' => \Zend\Validator\StringLength::class,
                        'options' => [
                            'max' => '64',
                            'min' => '1',
                        ],
                    ],
                ],
                'filters' => [],
                'name' => 'event_name',
                'description' => 'update event name if existis or event name if creating a new one',
                'field_type' => 'Varchar(64)',
            ],
            6 => [
                'required' => false,
                'validators' => [
                    0 => [
                        'name' => \Zend\I18n\Validator\DateTime::class,
                        'options' => [],
                    ],
                ],
                'filters' => [
                    0 => [
                        'name' => \Zend\Filter\DateTimeFormatter::class,
                        'options' => [
                            'format' => 'Y-m-d H:i:s',
                        ],
                    ],
                ],
                'name' => 'event_start_time',
                'description' => 'if creating a enw event is required, if not just updates the event time',
                'field_type' => 'Varchar(32)',
            ],
            7 => [
                'required' => true,
                'validators' => [],
                'filters' => [],
                'name' => 'base_odd',
                'description' => 'input format for odds (American, Decimal)',
                'field_type' => 'Numeric',
            ],
            8 => [
                'required' => false,
                'validators' => [],
                'filters' => [],
                'name' => 'base_points',
                'description' => 'Points for this selection',
                'field_type' => 'negatve or positive decimal number',
            ],
        ],
        'RiskManagement\\V1\\Rest\\Player\\Validator' => [
            0 => [
                'required' => true,
                'validators' => [
                    0 => [
                        'name' => \Zend\Validator\StringLength::class,
                        'options' => [
                            'max' => '32',
                            'min' => '1',
                        ],
                    ],
                    1 => [
                        'name' => \Zend\I18n\Validator\Alnum::class,
                        'options' => [],
                    ],
                ],
                'filters' => [],
                'name' => 'player_id',
                'description' => 'Alpha Numeric only, Max 32 Char, Unique id with in the existing players',
                'field_type' => 'Varchar(32)',
            ],
            1 => [
                'required' => false,
                'validators' => [
                    0 => [
                        'name' => \Zend\Validator\StringLength::class,
                        'options' => [
                            'max' => '64',
                            'min' => '1',
                        ],
                    ],
                ],
                'filters' => [],
                'name' => 'name',
                'description' => 'player name',
                'field_type' => 'Varchar(64)',
            ],
        ],
        'RiskManagement\\V1\\Rest\\Single\\Validator' => [
            0 => [
                'required' => true,
                'validators' => [
                    0 => [
                        'name' => \Zend\Validator\StringLength::class,
                        'options' => [
                            'max' => '32',
                            'min' => '1',
                        ],
                    ],
                    1 => [
                        'name' => \Zend\I18n\Validator\Alnum::class,
                        'options' => [],
                    ],
                ],
                'filters' => [],
                'name' => 'single_id',
                'description' => 'Alpha Numeric only, Max 32 Char, Unique id with in the existing singles',
                'field_type' => 'Varchar(32)',
            ],
            1 => [
                'required' => true,
                'validators' => [
                    0 => [
                        'name' => \Zend\Validator\StringLength::class,
                        'options' => [
                            'max' => '32',
                            'min' => '1',
                        ],
                    ],
                    1 => [
                        'name' => \Zend\I18n\Validator\Alnum::class,
                        'options' => [],
                    ],
                ],
                'filters' => [],
                'name' => 'event_id',
                'description' => 'Alpha Numeric only, Max 32 Char, Unique id with in the existing events',
                'field_type' => 'Varchar(32)',
            ],
            2 => [
                'required' => true,
                'validators' => [
                    0 => [
                        'name' => \Zend\Validator\StringLength::class,
                        'options' => [
                            'max' => '32',
                            'min' => '1',
                        ],
                    ],
                    1 => [
                        'name' => \Zend\I18n\Validator\Alnum::class,
                        'options' => [],
                    ],
                ],
                'filters' => [],
                'name' => 'odd_id',
                'description' => 'Alpha Numeric only, Max 32 Char, Unique id with in the existing odds',
                'field_type' => 'Varchar(32)',
            ],
            3 => [
                'required' => true,
                'validators' => [
                    0 => [
                        'name' => \Zend\Validator\StringLength::class,
                        'options' => [
                            'max' => '32',
                            'min' => '1',
                        ],
                    ],
                    1 => [
                        'name' => \Zend\I18n\Validator\Alnum::class,
                        'options' => [],
                    ],
                ],
                'filters' => [],
                'name' => 'odd_selection_id',
                'description' => 'Alpha Numeric only, Max 32 Char, Unique id with in the existing oddselections',
                'field_type' => 'Varchar(32)',
            ],
            4 => [
                'required' => true,
                'validators' => [
                    0 => [
                        'name' => \Zend\I18n\Validator\IsInt::class,
                        'options' => [],
                    ],
                ],
                'filters' => [],
                'name' => 'risk',
                'description' => 'Amount bet',
                'field_type' => 'Double or Float',
            ],
            5 => [
                'required' => false,
                'validators' => [],
                'filters' => [],
                'name' => 'win',
                'description' => 'Amoutn to win, if not specified it will be calculated',
                'field_type' => 'Double or Float',
            ],
        ],
        'RiskManagement\\V1\\Rest\\Multiple\\Validator' => [
            0 => [
                'required' => true,
                'validators' => [
                    0 => [
                        'name' => \Zend\Validator\StringLength::class,
                        'options' => [
                            'max' => '32',
                            'min' => '1',
                        ],
                    ],
                    1 => [
                        'name' => \Zend\I18n\Validator\Alnum::class,
                        'options' => [],
                    ],
                ],
                'filters' => [],
                'name' => 'multiple_id',
                'description' => 'Alpha Numeric only, Max 32 Char, Unique id with in the existing multiples',
                'field_type' => 'Varchar(32)',
            ],
            1 => [
                'required' => true,
                'validators' => [
                    0 => [
                        'name' => \Zend\I18n\Validator\IsInt::class,
                        'options' => [],
                    ],
                ],
                'filters' => [],
                'name' => 'risk',
                'description' => 'Amount to bet',
                'field_type' => 'Double or Float',
            ],
            2 => [
                'required' => false,
                'validators' => [],
                'filters' => [],
                'name' => 'win',
                'description' => 'Calculated win amount, if not specified system will calculate it',
                'field_type' => 'Double or Float',
            ],
        ],
        'RiskManagement\\V1\\Rest\\MultipleSelection\\Validator' => [
            0 => [
                'required' => true,
                'validators' => [
                    0 => [
                        'name' => \Zend\I18n\Validator\Alnum::class,
                        'options' => [],
                    ],
                    1 => [
                        'name' => \Zend\Validator\StringLength::class,
                        'options' => [
                            'max' => '32',
                            'min' => '1',
                        ],
                    ],
                ],
                'filters' => [],
                'name' => 'multiple_selection_id',
                'description' => 'Alpha Numeric only, Max 32 Char, Unique id with in the existing multipleselections',
                'field_type' => 'Varchar(32)',
            ],
            1 => [
                'required' => true,
                'validators' => [
                    0 => [
                        'name' => \Zend\I18n\Validator\Alnum::class,
                        'options' => [],
                    ],
                    1 => [
                        'name' => \Zend\Validator\StringLength::class,
                        'options' => [
                            'max' => '32',
                            'min' => '1',
                        ],
                    ],
                ],
                'filters' => [],
                'name' => 'odd_id',
                'description' => 'Alpha Numeric only, Max 32 Char, Unique id with in the existing events',
                'field_type' => 'Varchar(32)',
            ],
            2 => [
                'required' => true,
                'validators' => [
                    0 => [
                        'name' => \Zend\I18n\Validator\Alnum::class,
                        'options' => [],
                    ],
                    1 => [
                        'name' => \Zend\Validator\StringLength::class,
                        'options' => [
                            'max' => '32',
                            'min' => '1',
                        ],
                    ],
                ],
                'filters' => [],
                'name' => 'odd_selection_id',
                'description' => 'Alpha Numeric only, Max 32 Char, Unique id with in the existing oddselections',
                'field_type' => 'Varchar(32)',
            ],
        ],
    ],
];
