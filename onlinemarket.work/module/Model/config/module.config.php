<?php
declare(strict_types=1);
namespace Model;
use Laminas\ServiceManager\Factory\InvokableFactory;
return [
	'service_manager' => [
		'factories' => [
			'model-primary-adapter' => Adapter\Factory\PrimaryFactory::class,
			Table\ListingsTable::class => Table\Factory\ListingsTableFactory::class,
		],
	],
];
