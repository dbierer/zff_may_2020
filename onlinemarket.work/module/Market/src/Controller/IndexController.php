<?php
declare(strict_types=1);
namespace Market\Controller;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;
class IndexController extends AbstractActionController
{
	protected $container;
	public function __construct($container)
	{
		$this->container = $container;
	}
    public function indexAction()
    {
		$response = $this->getResponse();
		$headers  = $response->getHeaders();
		$headers->addHeaderLine('Accept', 'application/json');
        return new ViewModel(['some_date' => $this->someDate(), 'request' => $this->getRequest()]);
    }
    public function configAction()
    {
		return new ViewModel(['config' => $this->container->get('Config')]);
	}
}
