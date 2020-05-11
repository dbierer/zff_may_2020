<?php
namespace Market\Controller\Plugin;
use Zend\Mvc\Controller\Plugin\AbstractPlugin;
class DayWeekMonth extends AbstractPlugin 
{
	protected $now;
	public function __construct()
	{
		$this->now = new \DateTime();
	}
    public function __invoke()
    {
        return $this->getDay()
			   . ' ' . $this->getMonth()
			   . ' ' . $this->getYear()
			   . ' Week Number: ' . $this->getWeek();
    }
	public function getDay()
	{
		return $this->now->format('l, d');
	}
	public function getWeek()
	{
		return $this->now->format('W');
	}
	public function getMonth()
	{
		return $this->now->format('M');
	}
	public function getYear()
	{
		return $this->now->format('Y');
	}
}
