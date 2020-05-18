<?php
declare(strict_types=1);
namespace Demo;
use Laminas\Mvc\MvcEvent;
class Module
{
	public function onBootstrap(MvcEvent $e)
	{
		$em = $e->getApplication()->getEventManager();
		$em->attach('*', [$this, 'wildListener'], 99);
	}
	public function wildListener(MvcEvent $e)
	{
		$eventName   = $e->getName();
		$targetClass = get_class($e->getTarget());
		error_log(__METHOD__ . ': EVENT : ' . $eventName . ' : TRIGGER CLASS : ' . $targetClass);
	}
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
