<?php
/**
 * @author Rolf Bansbach
 */

return array(
    'router' => array(
        'routes' => array(
            'Home' => array(
                'type' => 'Literal',
                'options' => array(
                    'route'    => '/Admin',
                    'defaults' => array(
                        'controller' => 'Admin\Controller\IndexController',
                        'action'     => 'index',
                    ),
                ),
            ),
            'Admins' => array(
                'type' => 'Literal',
                'options' => array(
                    'route'    => '/Admin/Admins',
                    'defaults' => array(
                        'controller' => 'Admin\Controller\IndexController',
                        'action'     => 'admins',
                    ),
                ),
            ),
            'Users' => array(
                'type' => 'Literal',
                'options' => array(
                    'route'    => '/Admin/Users',
                    'defaults' => array(
                        'controller' => 'Admin\Controller\IndexController',
                        'action'     => 'users',
                    ),
                ),
            ),
            'Books' => array(
                'type' => 'Literal',
                'options' => array(
                    'route'    => '/Admin/Books',
                    'defaults' => array(
                        'controller' => 'Admin\Controller\IndexController',
                        'action'     => 'books',
                    ),
                ),
            ),
            'Reports' => array(
                'type' => 'Literal',
                'options' => array(
                    'route'    => '/Admin/Reports',
                    'defaults' => array(
                        'controller' => 'Admin\Controller\IndexController',
                        'action'     => 'reports',
                    ),
                ),
            ),
            'Login' => array(
                'type' => 'Literal',
                'options' => array(
                    'route'    => '/Auth',
                    'defaults' => array(
                        'controller' => 'Admin\Controller\AuthController',
                        'action'     => 'login',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'process' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/[:action]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                            ),
                        ),
                    ),
                ),
            ),
            'StatsRest' => array(
                'type'    => 'Segment',
                'options' => array(
                    'route'    => '/rest/stats[/:id]',
                    'constraints' => array(
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Admin\Controller\StatsRestController',
                    ),
                ),
            ),
        ),
    ),
    'service_manager' => array(
        'abstract_factories' => array(
            'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
            'Zend\Db\Adapter\AdapterAbstractServiceFactory',
            'Zend\Log\LoggerAbstractServiceFactory',
            'Admin\Controller\ControllersFactory',
            'Admin\Mapper\MapperFactory',
            'Admin\Model\ModelFactory',
        ),
        'factories' => [
            'myAuthService' => 'Admin\Auth\AuthServiceFactory',
            'myAuthStorage' => 'Admin\Auth\AuthStorageFactory',
        ],
        'invokables' => [
            
        ]
    ),
    'controllers' => array(
        'abstract_factories' => array(
            'Admin\Controller\ControllersFactory'
        ),
        'invokables' => array(
            
        ),
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'admin/index/index' => __DIR__ . '/../view/admin/index/index.phtml',
            'admin/index/admins' => __DIR__ . '/../view/admin/index/admins.phtml',
            'admin/index/users' => __DIR__ . '/../view/admin/index/users.phtml',
            'admin/index/books' => __DIR__ . '/../view/admin/index/books.phtml',
            'admin/index/reports' => __DIR__ . '/../view/admin/index/reports.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
            'layout/auth'           => __DIR__ . '/../view/layout/auth.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
);
