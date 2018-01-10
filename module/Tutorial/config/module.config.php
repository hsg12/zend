<?php

namespace Tutorial;

use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;
use Zend\Router\Http\Regex;
use Zend\Router\Http\Method;
use Zend\ServiceManager\Factory\InvokableFactory;

return [
    'router' => [
        'routes' => [
            'tutorial' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/tutorial',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'index',
                    ],
                ],
                'may_terminate' => true,
                'child_routes'  => [
                    'example' => [
                        'type'    => Segment::class,
                        'options' => [
                            'route'       => '/example[/:action]',
                            'constraints' => [
                                'action' => '[a-z]+',
                            ],
                            'defaults' => [
                                'controller' => Controller\ExampleController::class,
                                'action'     => 'index',
                                //'action'     => rand(0, 1) ? 'page1' : 'page2',
                            ],
                        ],
                    ],

                    /*'article' => [
                        'type'    => Segment::class,
                        'options' => [
                            'route'       => '/article[/:action][/:id]',
                            'constraints' => [
                                'action' => '[a-z]+',
                                'id'     => '[0-9]+',
                            ],
                            'defaults' => [
                                'controller' => Controller\ArticleController::class,
                                'action'     => 'index',
                            ],
                        ],
                    ],*/

                    /*'article' => [
                        'type'    => Regex::class,
                        'options' => [
                            'regex' => '/article(/(?<action>[a-z]+)(/(?<id>[0-9]+))?)?',
                            'spec'  => '/article/%action%',
                            'defaults' => [
                                'controller' => Controller\ArticleController::class,
                                'action'     => 'index',
                            ],
                        ],
                    ],*/

                    'article' => [
                        'type'    => Segment::class,
                        'options' => [
                            'route'       => '/article',
                            'defaults' => [
                                'controller' => Controller\ArticleController::class,
                                'action'     => 'index',
                            ],
                        ],
                    ],

                    'articleActionAdd' => [
                        'type'    => Segment::class,
                        'options' => [
                            'route'       => '/article/add',
                        ],
                        'child_routes' => [
                            'articleGet' => [
                                'type'    => Method::class,
                                'options' => [
                                    'verb'     => 'get',
                                    'defaults' => [
                                        'controller' => Controller\ArticleController::class,
                                        'action'     => 'add',
                                    ],
                                ],
                            ],
                            'articlePost' => [
                                'type'    => Method::class,
                                'options' => [
                                    'verb'     => 'post',
                                    'defaults' => [
                                        'controller' => Controller\ArticleController::class,
                                        'action'     => 'addPost',
                                    ],
                                ],
                            ],
                        ],
                    ],

                    'articleActionEdit' => [
                        'type'    => Segment::class,
                        'options' => [
                            'route'       => '/article/edit[/:id]',
                            'constraints' => [
                                'id' => '[0-9]+',
                            ],
                        ],
                        'child_routes' => [
                            'articleGet' => [
                                'type'    => Method::class,
                                'options' => [
                                    'verb'     => 'get',
                                    'defaults' => [
                                        'controller' => Controller\ArticleController::class,
                                        'action'     => 'edit',
                                    ],
                                ],
                            ],
                            'articlePost' => [
                                'type'    => Method::class,
                                'options' => [
                                    'verb'     => 'post',
                                    'defaults' => [
                                        'controller' => Controller\ArticleController::class,
                                        'action'     => 'editPost',
                                    ],
                                ],
                            ],
                        ],
                    ],

                    'ajax' => [
                        'type'    => Segment::class,
                        'options' => [
                            'route'       => '/ajax[/:action]',
                            'constraints' => [
                                'action' => '[a-z]+',
                            ],
                            'defaults' => [
                                'controller' => Controller\AjaxController::class,
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
            //Controller\IndexController::class => InvokableFactory::class,
            Controller\ExampleController::class => InvokableFactory::class,
            Controller\ArticleController::class => InvokableFactory::class,
            Controller\AjaxController::class    => InvokableFactory::class,
        ],
    ],
    'view_manager' => [
        'template_map' => [
            'tutorial/index/index' => __DIR__ . '/../view/tutorial/index/index.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
];
