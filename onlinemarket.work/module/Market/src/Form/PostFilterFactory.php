<?php
namespace Market\Form;
use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Laminas\InputFilter\Factory as FilterFactory;

class PostFilterFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param null|array $options
     * @return $requestedName instance
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
		$factory = new FilterFactory();
		return $factory->createInputFilter($container->get('market-post-filter-config'));
    }
}
