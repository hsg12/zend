<?php

namespace Admin;

use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;
use Zend\ServiceManager\Factory\InvokableFactory;

return [
    'router' => [
        'routes' => [
            'admin' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/admin',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'index',
                    ],
                ],
                'may_terminate' => true,
                'child_routes' => [
                    'article' => [
                        'type' => Segment::class,
                        'options' => [
                            'route'    => '/article[/:action[/:id]]',
                            'constraints'    => [
                                'action' => '[a-z]+',
                                'id'     => '[0-9]+',
                            ],
                            'defaults' => [
                                'controller' => Controller\ArticleController::class,
                                'action'     => 'index',
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
    'controllers' => [
        'factories' => [
            Controller\IndexController::class => InvokableFactory::class,
            Controller\ArticleController::class => InvokableFactory::class,
        ],
    ],
    'view_manager' => [
        'template_map' => [
            'admin/index/index' => __DIR__ . '/../view/admin/index/index.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
];
