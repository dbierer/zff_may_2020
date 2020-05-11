<?php
declare(strict_types=1);
namespace Market\Controller;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;
class PostController extends AbstractActionController
{
	protected $name = '';
	public function __construct(string $name)
	{
		$this->name = $name;
	}
    public function indexAction()
    {
        return new ViewModel();
    }
}
