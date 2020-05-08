<?php
namespace Market\Controller\Plugin;
use Laminas\Mvc\Controller\Plugin\AbstractPlugin;
class DatePlugin extends AbstractPlugin 
{
	const DATE_FORMAT = 'l, d M Y';
    public function __invoke() 
    {
		$date = new \DateTime();
        return $date->format(self::DATE_FORMAT);
    }
}
