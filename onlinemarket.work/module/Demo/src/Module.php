<?php
declare(strict_types=1);
namespace Demo;
class Module
{
    public function getConfig() : array
    {
        return include __DIR__ . '/../config/module.config.php';
    }
    public function getServiceConfig()
    {
		return [
			'services' => [
				'demo-test-scalar' => __FILE__,
				'demo-test-array' => [ __FILE__ ],
			],
		];
	}
}
