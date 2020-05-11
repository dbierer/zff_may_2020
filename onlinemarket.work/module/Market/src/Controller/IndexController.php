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
        return new ViewModel(
			[
				'some_date' => $this->someDate(), 
				'request' => $this->getRequest(),
				'dayWeekMonth' => $this->dayWeekMonth(),
			]
		);
    }
    public function adminAction()
    {
        $isLoggedIn = $this->params()->fromQuery('isLoggedIn', FALSE);
        if (!$isLoggedIn) {
            return $this->redirect()->toRoute('market/login');
        }
        return new ViewModel();
    }
    public function loginAction()
    {
        $data = $this->params()->fromPost();
		return new ViewModel(['data' => $data]);
	}
    public function configAction()
    {
		return new ViewModel(['config' => $this->container->get('Config')]);
	}
}
