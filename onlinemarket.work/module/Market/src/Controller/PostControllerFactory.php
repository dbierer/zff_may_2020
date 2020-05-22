<?php
namespace Market\Controller;

use Model\Table\ListingsTable;
use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Market\Controller\PostController;

class PostControllerFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param null|array $options
     * @return ViewController
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $controller = new PostController($container->get('Market\Form\PostForm'));
        $controller->setTable($container->get(ListingsTable::class));
        return $controller;
    }
}
