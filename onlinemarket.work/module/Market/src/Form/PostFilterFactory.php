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
        $config = $container->get('Config');
        $filtConfig = $config['market-post-filter-config'];
        // add validators that require $container
        $filtConfig['category']['validators'][] = [
            'name' => 'InArray',
            'options' => ['haystack' => $container->get('global-categories')]
        ];
        $filtConfig['expires']['validators'][] = [
            'name' => 'InArray',
            'options' => ['haystack' => $container->get('market-expire-days')]
        ];
        $filtConfig['cityCode']['validators'][] = [
            'name' => 'Callback',
            'options' => [
                'callback' =>
                    function ($val) {
                        if (!strpos($val, ',')) return FALSE;
                        [$city, $country] = explode(',', $val);
                        if ($city === NULL || $country === NULL) return FALSE;
                        if (strlen($country) != 2) return FALSE;
                        if ($country !== strtoupper($country)) return FALSE;
                        return TRUE;
                    }
            ]
        ];
		$factory = new FilterFactory();
		return $factory->createInputFilter($filtConfig);
    }
}
