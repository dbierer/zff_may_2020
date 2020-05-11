<?php
declare(strict_types=1);
namespace Market;
use Laminas\Router\Http\Literal;
use Laminas\Router\Http\Segment;
use Laminas\ServiceManager\Factory\InvokableFactory;
return [
    'router' => [
        'routes' => [
            'market' => [
                'type'    => Literal::class,
                'options' => [
                    // add additional params to "route" key if needed
                    'route'    => '/market',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'index',
                    ],
                ],
                'may_terminate' => TRUE,
                'child_routes' => [
                    'login'=> [
                        'type' => Literal::class,
                        'options' => [
                            // this route can be matched when the website
                            //  visitor types "/market/redirect"
                            'route' => '/login',
                            // controller inherits down
                            'defaults' => ['action' => 'login'],
                        ],
                    ],
                    'admin'=> [
                        'type' => Literal::class,
                        'options' => [
                            'route' => '/admin',
                            'defaults' => ['action' => 'admin'],
                        ],
                    ],
                    'config'=> [
                        'type' => Literal::class,
                        'options' => [
                            'route' => '/config',
                            'defaults' => ['action' => 'config'],
                        ],
                    ],
					'view' => [
						'type'    => Segment::class,
						'options' => [
							'route'    => '/view',
							'defaults' => [
								'controller' => Controller\ViewController::class,
								'action'     => 'index',
							],
						],
					],
					'post' => [
						'type'    => Segment::class,
						'options' => [
							// add additional params to "route" key if needed
							'route'    => '/post',
							'defaults' => [
								'controller' => Controller\PostController::class,
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
            Controller\IndexController::class => Controller\IndexControllerFactory::class,
            Controller\ViewController::class => Controller\ViewControllerFactory::class,
            Controller\PostController::class => Controller\PostControllerFactory::class,
        ],
    ],
    'controller_plugins' => [
        'factories' => [
            Controller\Plugin\DatePlugin::class => InvokableFactory::class,
            Controller\Plugin\DayWeekMonth::class => InvokableFactory::class,
        ],
        'aliases' => [
			'someDate' => Controller\Plugin\DatePlugin::class,
			'dayWeekMonth' => Controller\Plugin\DayWeekMonth::class,
		],
    ],
    'view_manager' => [
        'template_path_stack' => [__DIR__ . '/../view'],
    ],
];
