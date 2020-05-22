<?php
declare(strict_types=1);
namespace Demo;
use Laminas\Router\Http\Literal;
use Laminas\Router\Http\Segment;
use Laminas\ServiceManager\Factory\InvokableFactory;
return [
    'router' => [
        'routes' => [
            'demo' => [
                'type'    => Segment::class,
                'options' => [
                    // add additional params to "route" key if needed
                    'route'    => '/demo[/:action]',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'index',
                        'module'     => __NAMESPACE__
                    ],
                ],
            ],
        ],
    ],
    'controllers' => [
        'factories' => [
            Controller\IndexController::class => Controller\IndexControllerFactory::class,
        ],
    ],
    'view_manager' => [
        'template_path_stack' => [__DIR__ . '/../view'],
        'strategies' => ['ViewJsonStrategy'],
    ],
    'service_manager' => [
		'services' => [
			'demo-test-scalar' => __FILE__,
			'demo-test-array' => [ __FILE__ ],
		],
		'factories' => [
			'DemoAdapter' => Factory\AdapterFactory::class,
		],
	],
];
