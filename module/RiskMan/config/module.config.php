<?php
namespace RiskMan;
return array(
    'database_config' => array(
        'database_service' => 'DatabaseService',
        'database_config_key' => 'db1'
    ),
    'service_manager' => array(
        'factories' => array(
            //Database Service
            'DatabaseService' => 'RiskMan\\Database\\DatabaseFactory',

            //REST controllers
            'RiskMan\\V1\\Rest\\Single\\SingleResource' => 'RiskMan\\V1\\Rest\\Single\\SingleResourceFactory',
            'RiskMan\\V1\\Rest\\Multiple\\MultipleResource' => 'RiskMan\\V1\\Rest\\Multiple\\MultipleResourceFactory',
            'RiskMan\\V1\\Rest\\Event\\EventResource' => 'RiskMan\\V1\\Rest\\Event\\EventResourceFactory',
            'RiskMan\\V1\\Rest\\Odd\\OddResource' => 'RiskMan\\V1\\Rest\\Odd\\OddResourceFactory',
            'RiskMan\\V1\\Rest\\OddSelection\\OddSelectionResource' => 'RiskMan\\V1\\Rest\\OddSelection\\OddSelectionResourceFactory',
            
            
        ),
        'abstract_factories' => array(
            // Domain Feed Objects
            'RiskMan\\Domain\\Feed\\DomainFeedFactory',
            
            // Model Feed Objects
            'RiskMan\\Model\\ModelFeedFactory',
        ),
    ),
    'router' => array(
        'routes' => array(
            'risk-man.rest.single' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/bet/single[/:single_id]',
                    'defaults' => array(
                        'controller' => 'RiskMan\\V1\\Rest\\Single\\Controller',
                    ),
                ),
            ),
            'risk-man.rest.multiple' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/bet/multiple[/:multiple_id]',
                    'defaults' => array(
                        'controller' => 'RiskMan\\V1\\Rest\\Multiple\\Controller',
                    ),
                ),
            ),
            'risk-man.rest.event' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/feed/event[/:event_id]',
                    'defaults' => array(
                        'controller' => 'RiskMan\\V1\\Rest\\Event\\Controller',
                    ),
                ),
            ),
            'risk-man.rest.odd' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/feed/odd[/:odd_id]',
                    'defaults' => array(
                        'controller' => 'RiskMan\\V1\\Rest\\Odd\\Controller',
                    ),
                ),
            ),
            'risk-man.rest.odd-selection' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/feed/odd-selection[/:odd_selection_id]',
                    'defaults' => array(
                        'controller' => 'RiskMan\\V1\\Rest\\OddSelection\\Controller',
                    ),
                ),
            ),
        ),
    ),
    'zf-versioning' => array(
        'uri' => array(
            0 => 'risk-man.rest.single',
            1 => 'risk-man.rest.multiple',
            2 => 'risk-man.rest.event',
            3 => 'risk-man.rest.odd',
            4 => 'risk-man.rest.odd-selection',
        ),
    ),
    'zf-rest' => array(
        'RiskMan\\V1\\Rest\\Single\\Controller' => array(
            'listener' => 'RiskMan\\V1\\Rest\\Single\\SingleResource',
            'route_name' => 'risk-man.rest.single',
            'route_identifier_name' => 'single_id',
            'collection_name' => 'single',
            'entity_http_methods' => array(
                0 => 'GET',
                1 => 'PATCH',
                2 => 'PUT',
            ),
            'collection_http_methods' => array(
                0 => 'GET',
                1 => 'POST',
            ),
            'collection_query_whitelist' => array(),
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => 'RiskMan\\V1\\Rest\\Single\\SingleEntity',
            'collection_class' => 'RiskMan\\V1\\Rest\\Single\\SingleCollection',
            'service_name' => 'Single',
        ),
        'RiskMan\\V1\\Rest\\Multiple\\Controller' => array(
            'listener' => 'RiskMan\\V1\\Rest\\Multiple\\MultipleResource',
            'route_name' => 'risk-man.rest.multiple',
            'route_identifier_name' => 'multiple_id',
            'collection_name' => 'multiple',
            'entity_http_methods' => array(
                0 => 'GET',
                1 => 'PATCH',
                2 => 'PUT',
            ),
            'collection_http_methods' => array(
                0 => 'GET',
                1 => 'POST',
            ),
            'collection_query_whitelist' => array(),
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => 'RiskMan\\V1\\Rest\\Multiple\\MultipleEntity',
            'collection_class' => 'RiskMan\\V1\\Rest\\Multiple\\MultipleCollection',
            'service_name' => 'Multiple',
        ),
        'RiskMan\\V1\\Rest\\Event\\Controller' => array(
            'listener' => 'RiskMan\\V1\\Rest\\Event\\EventResource',
            'route_name' => 'risk-man.rest.event',
            'route_identifier_name' => 'event_id',
            'collection_name' => 'event',
            'entity_http_methods' => array(
                0 => 'GET',
                1 => 'PATCH',
                2 => 'PUT',
            ),
            'collection_http_methods' => array(
                0 => 'GET',
                1 => 'POST',
            ),
            'collection_query_whitelist' => array(),
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => 'RiskMan\\V1\\Rest\\Event\\EventEntity',
            'collection_class' => 'RiskMan\\V1\\Rest\\Event\\EventCollection',
            'service_name' => 'Event',
        ),
        'RiskMan\\V1\\Rest\\Odd\\Controller' => array(
            'listener' => 'RiskMan\\V1\\Rest\\Odd\\OddResource',
            'route_name' => 'risk-man.rest.odd',
            'route_identifier_name' => 'odd_id',
            'collection_name' => 'odd',
            'entity_http_methods' => array(
                0 => 'GET',
                1 => 'PATCH',
                2 => 'PUT',
            ),
            'collection_http_methods' => array(
                0 => 'GET',
                1 => 'POST',
            ),
            'collection_query_whitelist' => array(),
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => 'RiskMan\\V1\\Rest\\Odd\\OddEntity',
            'collection_class' => 'RiskMan\\V1\\Rest\\Odd\\OddCollection',
            'service_name' => 'Odd',
        ),
        'RiskMan\\V1\\Rest\\OddSelection\\Controller' => array(
            'listener' => 'RiskMan\\V1\\Rest\\OddSelection\\OddSelectionResource',
            'route_name' => 'risk-man.rest.odd-selection',
            'route_identifier_name' => 'odd_selection_id',
            'collection_name' => 'odd_selection',
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
            'entity_class' => 'RiskMan\\V1\\Rest\\OddSelection\\OddSelectionEntity',
            'collection_class' => 'RiskMan\\V1\\Rest\\OddSelection\\OddSelectionCollection',
            'service_name' => 'OddSelection',
        ),
    ),
    'zf-content-negotiation' => array(
        'controllers' => array(
            'RiskMan\\V1\\Rest\\Single\\Controller' => 'HalJson',
            'RiskMan\\V1\\Rest\\Multiple\\Controller' => 'HalJson',
            'RiskMan\\V1\\Rest\\Event\\Controller' => 'HalJson',
            'RiskMan\\V1\\Rest\\Odd\\Controller' => 'HalJson',
            'RiskMan\\V1\\Rest\\OddSelection\\Controller' => 'HalJson',
        ),
        'accept_whitelist' => array(
            'RiskMan\\V1\\Rest\\Single\\Controller' => array(
                0 => 'application/vnd.risk-man.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ),
            'RiskMan\\V1\\Rest\\Multiple\\Controller' => array(
                0 => 'application/vnd.risk-man.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ),
            'RiskMan\\V1\\Rest\\Event\\Controller' => array(
                0 => 'application/vnd.risk-man.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ),
            'RiskMan\\V1\\Rest\\Odd\\Controller' => array(
                0 => 'application/vnd.risk-man.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ),
            'RiskMan\\V1\\Rest\\OddSelection\\Controller' => array(
                0 => 'application/vnd.risk-man.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ),
        ),
        'content_type_whitelist' => array(
            'RiskMan\\V1\\Rest\\Single\\Controller' => array(
                0 => 'application/vnd.risk-man.v1+json',
                1 => 'application/json',
            ),
            'RiskMan\\V1\\Rest\\Multiple\\Controller' => array(
                0 => 'application/vnd.risk-man.v1+json',
                1 => 'application/json',
            ),
            'RiskMan\\V1\\Rest\\Event\\Controller' => array(
                0 => 'application/vnd.risk-man.v1+json',
                1 => 'application/json',
            ),
            'RiskMan\\V1\\Rest\\Odd\\Controller' => array(
                0 => 'application/vnd.risk-man.v1+json',
                1 => 'application/json',
            ),
            'RiskMan\\V1\\Rest\\OddSelection\\Controller' => array(
                0 => 'application/vnd.risk-man.v1+json',
                1 => 'application/json',
            ),
        ),
    ),
    'zf-hal' => array(
        'metadata_map' => array(
            'RiskMan\\V1\\Rest\\Single\\SingleEntity' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'risk-man.rest.single',
                'route_identifier_name' => 'single_id',
                'hydrator' => 'Zend\\Hydrator\\ArraySerializable',
            ),
            'RiskMan\\V1\\Rest\\Single\\SingleCollection' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'risk-man.rest.single',
                'route_identifier_name' => 'single_id',
                'is_collection' => true,
            ),
            'RiskMan\\V1\\Rest\\Multiple\\MultipleEntity' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'risk-man.rest.multiple',
                'route_identifier_name' => 'multiple_id',
                'hydrator' => 'Zend\\Hydrator\\ArraySerializable',
            ),
            'RiskMan\\V1\\Rest\\Multiple\\MultipleCollection' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'risk-man.rest.multiple',
                'route_identifier_name' => 'multiple_id',
                'is_collection' => true,
            ),
            'RiskMan\\V1\\Rest\\Event\\EventEntity' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'risk-man.rest.event',
                'route_identifier_name' => 'event_id',
                'hydrator' => 'Zend\\Hydrator\\ArraySerializable',
            ),
            'RiskMan\\V1\\Rest\\Event\\EventCollection' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'risk-man.rest.event',
                'route_identifier_name' => 'event_id',
                'is_collection' => true,
            ),
            'RiskMan\\V1\\Rest\\Odd\\OddEntity' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'risk-man.rest.odd',
                'route_identifier_name' => 'odd_id',
                'hydrator' => 'Zend\\Hydrator\\ArraySerializable',
            ),
            'RiskMan\\V1\\Rest\\Odd\\OddCollection' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'risk-man.rest.odd',
                'route_identifier_name' => 'odd_id',
                'is_collection' => true,
            ),
            'RiskMan\\V1\\Rest\\OddSelection\\OddSelectionEntity' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'risk-man.rest.odd-selection',
                'route_identifier_name' => 'odd_selection_id',
                'hydrator' => 'Zend\\Hydrator\\ArraySerializable',
            ),
            'RiskMan\\V1\\Rest\\OddSelection\\OddSelectionCollection' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'risk-man.rest.odd-selection',
                'route_identifier_name' => 'odd_selection_id',
                'is_collection' => true,
            ),
        ),
    ),
    'zf-content-validation' => array(
        'RiskMan\\V1\\Rest\\Event\\Controller' => array(
            'input_filter' => 'RiskMan\\V1\\Rest\\Event\\Validator',
        ),
        'RiskMan\\V1\\Rest\\Odd\\Controller' => array(
            'input_filter' => 'RiskMan\\V1\\Rest\\Odd\\Validator',
        ),
        'RiskMan\\V1\\Rest\\OddSelection\\Controller' => array(
            'input_filter' => 'RiskMan\\V1\\Rest\\OddSelection\\Validator',
        ),
        'RiskMan\\V1\\Rest\\Single\\Controller' => array(
            'input_filter' => 'RiskMan\\V1\\Rest\\Single\\Validator',
        ),
        'RiskMan\\V1\\Rest\\Multiple\\Controller' => array(
            'input_filter' => 'RiskMan\\V1\\Rest\\Multiple\\Validator',
        ),
    ),
    'input_filter_specs' => array(
        'RiskMan\\V1\\Rest\\Sport\\Validator' => array(
            0 => array(
                'required' => true,
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\Validator\\StringLength',
                        'options' => array(
                            'min' => '1',
                            'max' => '32',
                        ),
                    ),
                    1 => array(
                        'name' => 'Zend\\I18n\\Validator\\Alnum',
                        'options' => array(),
                    ),
                ),
                'filters' => array(
                    0 => array(
                        'name' => 'Zend\\Filter\\StringTrim',
                        'options' => array(),
                    ),
                ),
                'name' => 'sport_id',
                'description' => 'Book sport_id',
            ),
            1 => array(
                'required' => false,
                'validators' => array(),
                'filters' => array(),
                'name' => 'name',
                'description' => 'Book sport name',
            ),
        ),
        'RiskMan\\V1\\Rest\\Event\\Validator' => array(
            0 => array(
                'required' => true,
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\Validator\\StringLength',
                        'options' => array(
                            'min' => '1',
                            'max' => '32',
                        ),
                    ),
                    1 => array(
                        'name' => 'Zend\\I18n\\Validator\\Alnum',
                        'options' => array(),
                    ),
                ),
                'filters' => array(
                    0 => array(
                        'name' => 'Zend\\Filter\\StringTrim',
                        'options' => array(),
                    ),
                ),
                'name' => 'event_id',
                'description' => 'Bookmaker event_id',
            ),
            1 => array(
                'required' => false,
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\Validator\\StringLength',
                        'options' => array(
                            'min' => '1',
                            'max' => '128',
                        ),
                    ),
                ),
                'filters' => array(
                    0 => array(
                        'name' => 'Zend\\Filter\\StringTrim',
                        'options' => array(),
                    ),
                ),
                'name' => 'event_name',
            ),
            2 => array(
                'required' => false,
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\Validator\\StringLength',
                        'options' => array(
                            'min' => '1',
                            'max' => '32',
                        ),
                    ),
                    1 => array(
                        'name' => 'Zend\\I18n\\Validator\\Alnum',
                        'options' => array(),
                    ),
                ),
                'filters' => array(
                    0 => array(
                        'name' => 'Zend\\Filter\\StringTrim',
                        'options' => array(),
                    ),
                ),
                'name' => 'sport_id',
            ),
            3 => array(
                'required' => false,
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\Validator\\StringLength',
                        'options' => array(
                            'min' => '1',
                            'max' => '128',
                        ),
                    ),
                ),
                'filters' => array(
                    0 => array(
                        'name' => 'Zend\\Filter\\StringTrim',
                        'options' => array(),
                    ),
                ),
                'name' => 'sport_name',
            ),
            4 => array(
                'required' => false,
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\Validator\\StringLength',
                        'options' => array(
                            'min' => '1',
                            'max' => '32',
                        ),
                    ),
                    1 => array(
                        'name' => 'Zend\\I18n\\Validator\\Alnum',
                        'options' => array(),
                    ),
                ),
                'filters' => array(
                    0 => array(
                        'name' => 'Zend\\Filter\\StringTrim',
                        'options' => array(),
                    ),
                ),
                'name' => 'region_id',
            ),
            5 => array(
                'required' => false,
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\Validator\\StringLength',
                        'options' => array(
                            'min' => '1',
                            'max' => '128',
                        ),
                    ),
                ),
                'filters' => array(
                    0 => array(
                        'name' => 'Zend\\Filter\\StringTrim',
                        'options' => array(),
                    ),
                ),
                'name' => 'region_name',
            ),
            6 => array(
                'required' => false,
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\Validator\\StringLength',
                        'options' => array(
                            'min' => '1',
                            'max' => '32',
                        ),
                    ),
                    1 => array(
                        'name' => 'Zend\\I18n\\Validator\\Alnum',
                        'options' => array(),
                    ),
                ),
                'filters' => array(
                    0 => array(
                        'name' => 'Zend\\Filter\\StringTrim',
                        'options' => array(),
                    ),
                ),
                'name' => 'league_id',
                'description' => 'league_name',
            ),
            7 => array(
                'required' => false,
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\Validator\\StringLength',
                        'options' => array(
                            'min' => '1',
                            'max' => '128',
                        ),
                    ),
                ),
                'filters' => array(
                    0 => array(
                        'name' => 'Zend\\Filter\\StringTrim',
                        'options' => array(),
                    ),
                ),
                'name' => 'league_name',
            ),
            8 => array(
                'required' => false,
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\Validator\\StringLength',
                        'options' => array(
                            'min' => '1',
                            'max' => '32',
                        ),
                    ),
                    1 => array(
                        'name' => 'Zend\\I18n\\Validator\\Alnum',
                        'options' => array(),
                    ),
                ),
                'filters' => array(
                    0 => array(
                        'name' => 'Zend\\Filter\\StringTrim',
                        'options' => array(),
                    ),
                ),
                'name' => 'period_id',
            ),
            9 => array(
                'required' => false,
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\Validator\\StringLength',
                        'options' => array(
                            'min' => '1',
                            'max' => '128',
                        ),
                    ),
                ),
                'filters' => array(
                    0 => array(
                        'name' => 'Zend\\Filter\\StringTrim',
                        'options' => array(),
                    ),
                ),
                'name' => 'period_name',
            ),
            10 => array(
                'required' => false,
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\Validator\\StringLength',
                        'options' => array(
                            'min' => '1',
                            'max' => '64',
                        ),
                    ),
                    1 => array(
                        'name' => 'RiskMan\\Validator\\ValidateDateTime',
                        'options' => array(
                        ),
                    ),
                ),
                'filters' => array(
                    0 => array(
                        'name' => 'Zend\\Filter\\StringTrim',
                        'options' => array(),
                    ),
                ),
                'name' => 'datetime',
            ),
        ),
        'RiskMan\\V1\\Rest\\Odd\\Validator' => array(
            0 => array(
                'required' => true,
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\Validator\\StringLength',
                        'options' => array(
                            'min' => '1',
                            'max' => '32',
                        ),
                    ),
                    1 => array(
                        'name' => 'Zend\\I18n\\Validator\\Alnum',
                        'options' => array(),
                    ),
                ),
                'filters' => array(
                    0 => array(
                        'name' => 'Zend\\Filter\\StringTrim',
                        'options' => array(),
                    ),
                ),
                'name' => 'odd_id',
                'description' => 'Bookmaker odd_id',
            ),
            1 => array(
                'required' => false,
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\Validator\\StringLength',
                        'options' => array(
                            'min' => '1',
                            'max' => '128',
                        ),
                    ),
                ),
                'filters' => array(
                    0 => array(
                        'name' => 'Zend\\Filter\\StringTrim',
                        'options' => array(),
                    ),
                ),
                'name' => 'odd_name',
            ),
            2 => array(
                'required' => true,
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\Validator\\StringLength',
                        'options' => array(
                            'min' => '1',
                            'max' => '32',
                        ),
                    ),
                    1 => array(
                        'name' => 'Zend\\I18n\\Validator\\Alnum',
                        'options' => array(),
                    )
                ),
                'filters' => array(
                    0 => array(
                        'name' => 'Zend\\Filter\\StringTrim',
                        'options' => array(),
                    ),
                ),
                'name' => 'event_id',
            ),
            3 => array(
                'required' => false,
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\Validator\\StringLength',
                        'options' => array(
                            'max' => '64',
                            'min' => '1',
                        ),
                    ),
                    1 => array(
                        'name' => 'RiskMan\\Validator\\ValidateDateTime',
                        'options' => array(
                        ),
                    ),
                ),
                'filters' => array(
                    0 => array(
                        'name' => 'Zend\\Filter\\StringTrim',
                        'options' => array(),
                    ),
                ),
                'name' => 'datetime',
            ),
        ),
        'RiskMan\\V1\\Rest\\OddSelection\\Validator' => array(
            0 => array(
                'required' => true,
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\Validator\\StringLength',
                        'options' => array(
                            'min' => '1',
                            'max' => '32',
                        ),
                    ),
                    1 => array(
                        'name' => 'Zend\\I18n\\Validator\\Alnum',
                        'options' => array(),
                    ),
                ),
                'filters' => array(
                    0 => array(
                        'name' => 'Zend\\Filter\\StringTrim',
                        'options' => array(),
                    ),
                ),
                'name' => 'odd_selection_id',
            ),
            1 => array(
                'required' => false,
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\Validator\\StringLength',
                        'options' => array(
                            'min' => '1',
                            'max' => '128',
                        ),
                    ),
                ),
                'filters' => array(
                    0 => array(
                        'name' => 'Zend\\Filter\\StringTrim',
                        'options' => array(),
                    ),
                ),
                'name' => 'odd_selection_name',
            ),
            2 => array(
                'required' => true,
                'validators' => array(),
                'filters' => array(
                    0 => array(
                        'name' => 'Zend\\Filter\\StringTrim',
                        'options' => array(),
                    ),
                ),
                'name' => 'odd_id',
            ),
            3 => array(
                'required' => false,
                'validators' => array(),
                'filters' => array(
                    0 => array(
                        'name' => 'Zend\\Filter\\StringTrim',
                        'options' => array(),
                    ),
                ),
                'name' => 'points',
            ),
            4 => array(
                'required' => false,
                'validators' => array(),
                'filters' => array(
                    0 => array(
                        'name' => 'Zend\\Filter\\StringTrim',
                        'options' => array(),
                    ),
                ),
                'name' => 'asian_handicap',
            ),
        ),
        'RiskMan\\V1\\Rest\\Single\\Validator' => array(
            0 => array(
                'required' => true,
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\Validator\\StringLength',
                        'options' => array(
                            'min' => '1',
                            'max' => '32',
                        ),
                    ),
                    1 => array(
                        'name' => 'Zend\\I18n\\Validator\\Alnum',
                        'options' => array(),
                    ),
                ),
                'filters' => array(
                    0 => array(
                        'name' => 'Zend\\Filter\\StringTrim',
                        'options' => array(),
                    ),
                ),
                'name' => 'single_id',
                'description' => 'operator bet id',
            ),
            1 => array(
                'required' => true,
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\Validator\\StringLength',
                        'options' => array(
                            'min' => '1',
                            'max' => '32',
                        ),
                    ),
                    1 => array(
                        'name' => 'Zend\\I18n\\Validator\\Alnum',
                        'options' => array(),
                    ),
                ),
                'filters' => array(
                    0 => array(
                        'name' => 'Zend\\Filter\\StringTrim',
                        'options' => array(),
                    ),
                ),
                'name' => 'odd_id',
            ),
            2 => array(
                'required' => true,
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\Validator\\StringLength',
                        'options' => array(
                            'min' => '1',
                            'max' => '32',
                        ),
                    ),
                    1 => array(
                        'name' => 'Zend\\I18n\\Validator\\Alnum',
                        'options' => array(),
                    ),
                ),
                'filters' => array(
                    0 => array(
                        'name' => 'Zend\\Filter\\StringTrim',
                        'options' => array(),
                    ),
                ),
                'name' => 'odd_selection_id',
            ),
            3 => array(
                'required' => false,
                'validators' => array(),
                'filters' => array(
                    0 => array(
                        'name' => 'Zend\\Filter\\StringTrim',
                        'options' => array(),
                    ),
                ),
                'name' => 'approval',
            ),
            4 => array(
                'required' => false,
                'validators' => array(),
                'filters' => array(
                    0 => array(
                        'name' => 'Zend\\Filter\\StringTrim',
                        'options' => array(),
                    ),
                ),
                'name' => 'odds',
            ),
            5 => array(
                'required' => false,
                'validators' => array(),
                'filters' => array(
                    0 => array(
                        'name' => 'Zend\\Filter\\StringTrim',
                        'options' => array(),
                    ),
                ),
                'name' => 'points',
            ),
            6 => array(
                'required' => true,
                'validators' => array(),
                'filters' => array(
                    0 => array(
                        'name' => 'Zend\\Filter\\StringTrim',
                        'options' => array(),
                    ),
                ),
                'name' => 'risk',
            ),
            7 => array(
                'required' => false,
                'validators' => array(),
                'filters' => array(
                    0 => array(
                        'name' => 'Zend\\Filter\\StringTrim',
                        'options' => array(),
                    ),
                ),
                'name' => 'win',
            ),
        ),
        'RiskMan\\V1\\Rest\\Multiple\\Validator' => array(
            0 => array(
                'required' => true,
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\Validator\\StringLength',
                        'options' => array(
                            'min' => '1',
                            'max' => '32',
                        ),
                    ),
                    1 => array(
                        'name' => 'Zend\\I18n\\Validator\\Alnum',
                        'options' => array(),
                    ),
                ),
                'filters' => array(
                    0 => array(
                        'name' => 'Zend\\Filter\\StringTrim',
                        'options' => array(),
                    ),
                ),
                'name' => 'multiple_id',
                'description' => 'operator bet_id',
            ),
            1 => array(
                'required' => true,
                'validators' => array(),
                'filters' => array(),
                'name' => 'selections',
            ),
            2 => array(
                'required' => false,
                'validators' => array(),
                'filters' => array(),
                'name' => 'approval',
            ),
            3 => array(
                'required' => true,
                'validators' => array(),
                'filters' => array(),
                'name' => 'risk',
            ),
            4 => array(
                'required' => false,
                'validators' => array(),
                'filters' => array(),
                'name' => 'win',
            ),
        ),
    ),
);
