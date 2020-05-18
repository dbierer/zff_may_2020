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
        $em->attach(MvcEvent::EVENT_DISPATCH, [$this, 'onDispatch']);
    }
    public function onDispatch(MvcEvent $e)
    {
        $container = $e->getApplication()->getServiceManager();
        $layout = $e->getViewModel();
        $layout->setVariable('categories', $container->get('global-categories'));
    }
}
