<?php
/**
 * @see       https://github.com/laminas/laminas-mvc-skeleton for the canonical source repository
 * @copyright https://github.com/laminas/laminas-mvc-skeleton/blob/master/COPYRIGHT.md
 * @license   https://github.com/laminas/laminas-mvc-skeleton/blob/master/LICENSE.md New BSD License
 */
declare(strict_types=1);
namespace Application;
use Laminas\Mvc\MvcEvent;
class Module
{
    public function getConfig() : array
    {
        return include __DIR__ . '/../config/module.config.php';
    }
    public function onBootstrap(MvcEvent $e)
    {
        $em = $e->getApplication()->getEventManager();
        $em->attach(MvcEvent::EVENT_DISPATCH, [$this, 'onDispatch'], 99);
        $em->attach(MvcEvent::EVENT_DISPATCH, [$this, 'onModule'], 999);
    }
    public function onModule(MvcEvent $e)
    {
		$module = $e->getRouteMatch()->getParam('module',NULL);
		echo 'MODULE: ' . $module;
		// NOTE: could do something specific to this module
		//       for example if it's the "Admin" module, switch layouts
	}
    public function onDispatch(MvcEvent $e)
    {
        $container = $e->getApplication()->getServiceManager();
        $layout = $e->getViewModel();
        $layout->setVariable('categories', $container->get('global-categories'));
    }
}
