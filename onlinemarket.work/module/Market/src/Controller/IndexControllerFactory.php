<?php
namespace Market\Controller;

use Model\Table\ListingsTable;
use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Market\Controller\IndexController;

class IndexControllerFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param null|array $options
     * @return IndexController
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $controller = new IndexController($container->get('global-categories'), $container->get('Config'));
        $controller->setTable($container->get(ListingsTable::class));
        return $controller;
    }
}
