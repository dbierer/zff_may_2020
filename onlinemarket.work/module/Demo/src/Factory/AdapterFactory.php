<?php
namespace Demo\Factory;
use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Laminas\Db\Adapter\Adapter;
class AdapterFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param null|array $options
     * @return $requestedName instance
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new Adapter($container->get('db-config'));
    }
}
