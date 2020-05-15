<?php
declare(strict_types=1);
namespace Market;
use Laminas\Router\Http\Literal;
use Laminas\Router\Http\Segment;
use Laminas\Hydrator\ArraySerializableHydrator;
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
    'service_manager' => [
        'factories' => [
            Form\PostForm::class => Form\PostFormFactory::class,
        ],
        'services' => [
            // 'market-post-form-config' overrides needed:
            // $formConfig['elements']['category']['spec']['options']['value_options'] = $combinedCategories
            // $formConfig['elements']['expires']['spec']['options']['value_options'] = $expireDays
            // $formConfig['elements']['captcha']['spec']['options']['captcha'] = $captchaAdapter
            'market-post-form-config' => [
                'hydrator' => ArraySerializableHydrator::class,
                'attributes' => ['method' => 'post'],
                'elements' => [
                    'category' => [
                        'spec' => [
                            'name' => 'category',
                            'type' => 'select',
                            'options' => [
                                'label' => 'Category',
                                // needs to be overridden by the factory
                                'value_options' => NULL,
                            ],
                            'attributes' => ['title' => 'Please select a category'],
                            'label_attributes' => ['style' => 'display: block'],
                        ],
                    ],
                    'title' => [
                        'spec' => [
                            'name' => 'title',
                            'type' => 'text',
                            'options' => [
                                'label' => 'Title',
                            ],
                            'attributes' => ['placeholder' => 'Enter posting title'],
                            'label_attributes' => ['style' => 'display: block'],
                        ],
                    ],
                    'photo_filename' => [
                        'spec' => [
                            'name' => 'photo_filename',
                            'type' => 'text',
                            'options' => [
                                'label' => 'Photo File',
                                'label_attributes' => ['style' => 'display: block'],
                            ],
                            'attributes' => [
                                'maxlength' => 1024,
                                'placeholder' => 'Enter image URL',
                            ],

                        ],
                    ],
                    'price' => [
                        'spec' => [
                            'name' => 'price',
                            'type' => 'text',
                            'options' => [
                                'label' => 'Price',
                                'label_attributes' => ['style' => 'display: block'],
                            ],
                            'attributes' => [
                                'title' => 'Enter price as nnn.nn',
                                'size' => 16,
                                'maxlength' => 16,
                                'placeholder' => 'Enter a value',
                            ],
                        ],
                    ],
                    'expires' => [
                        'spec' => [
                            'name' => 'expires',
                            'type' => 'radio',
                            'options' => [
                                'label' => 'Expires',
                                // needs to be overridden by the factory
                                'value_options' => NULL,
                            ],
                            'attributes' => [
                                'title' => 'The expiration date will be calculated from today',
                                'class' =>  'expiresButton',
                            ],
                        ],
                    ],
                    'cityCode' => [
                        'spec' => [
                            'name' => 'cityCode',
                            'type' => 'text',
                            'options' => [
                                'label' => 'Nearest City,Country',
                                'label_attributes' => ['style' => 'display: inline'],
                            ],
                            'attributes' => [
                                'title' => 'Enter as "city,country" using 2 letter ISO code for country',
                                'id' => 'cityCode',
                                'placeholder' => 'City Name,CC',
                            ],
                        ],
                    ],
                    'contact_name' => [
                        'spec' => [
                            'name' => 'contact_name',
                            'type' => 'text',
                            'options' => [
                                'label' => 'Contact Name',
                                'label_attributes' => ['style' => 'display: block'],
                            ],
                            'attributes' => [
                                'title' => 'Enter the name of the person to contact for this item',
                                'size' => 40,
                                'maxlength' => 255,
                            ],
                        ],
                    ],
                    'contact_phone' => [
                        'spec' => [
                            'name' => 'contact_phone',
                            'type' => 'text',
                            'options' => [
                                'label' => 'Contact Phone Number',
                                'label_attributes' => ['style' => 'display: block'],
                            ],
                            'attributes' => [
                                'title' => 'Enter the phone number of the person to contact for this item',
                                'size' => 20,
                                'maxlength' => 32,
                            ],
                        ],
                    ],
                    'contact_email' => [
                        'spec' => [
                            'name' => 'contact_email',
                            'type' => 'email',
                            'options' => [
                                'label' => 'Contact Email',
                                'label_attributes' => ['style' => 'display: block'],
                            ],
                            'attributes' => [
                                'title' => 'Enter the email address of the person to contact for this item',
                                'size' => 40,
                                'maxlength' => 255,
                            ],
                        ],
                    ],
                    'description' => [
                        'spec' => [
                            'name' => 'description',
                            'type' => 'textarea',
                            'options' => [
                                'label' => 'Description',
                            ],
                            'attributes' => [
                                'title' => 'Enter a suitable description for this posting',
                                'rows' => 4,
                                'cols' => 80,
                            ],
                        ],
                    ],
                    'delete_code' => [
                        'spec' => [
                            'name' => 'delete_code',
                            'type' => 'text',
                            'options' => [
                                'label' => 'Delete Code',
                                'label_attributes' => ['style' => 'display: block'],
                            ],
                            'attributes' => [
                                'title' => 'Enter the delete code for this item',
                                'size' => 16,
                                'maxlength' => 16,
                            ],
                        ],
                    ],
                    'captcha' => [
                        'spec' => [
                            'name' => 'captcha',
                            'type' => 'captcha',
                            'options' => [
                                'label'   => 'Help us to prevent SPAM!',
                                // needs to be overridden by the factory
                                'captcha' => NULL,
                            ],
                            'attributes' => [
                                'title' => 'Enter the delete code for this item',
                                'size' => 16,
                                'maxlength' => 16,
                            ],
                        ],
                    ],
                    'submit' => [
                        'spec' => [
                            'name' => 'submit',
                            'type' => 'submit',
                            'attributes' => [
                                'style' => 'font-size: 16pt; font-weight:bold;',
                                'class' => 'btn btn-success white',
                                'value' => 'Post',
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
];
