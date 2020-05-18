<?php
// tests input filter
include 'vendor/autoload.php';
use Laminas\InputFilter\Factory as FilterFactory;
$config = include __DIR__ . '/module/Market/config/module.config.php';
$global = include __DIR__ . '/config/autoload/global.php';
$filtConfig = $config['market-post-filter-config'];
$filtConfig['category']['validators'][] = [
    'name' => 'InArray',
    'haystack' => $global['service_manager']['services']['global-categories']
];
$filtConfig['expires']['validators'][] = [
    'name' => 'InArray',
    'options' => [
        'haystack' => $global['service_manager']['services']['market-expire-days']
    ]
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
var_dump($factory->createInputFilter($filtConfig));
