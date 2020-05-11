<?php
declare(strict_types=1);
namespace Demo\Controller;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ {ViewModel, JsonModel};
class IndexController extends AbstractActionController
{
	public $demoScalar = NULL;
	public $demoArray = NULL;
    public function indexAction()
    {
        return new ViewModel(['demoScalar' => $this->demoScalar, 'demoArray' => $this->demoArray]);
    }
    public function parentAction()
    {
		$child1 = new ViewModel();
		$child1->setTemplate('demo/index/child1');
		$child2 = new ViewModel();
		$child2->setTemplate('demo/index/child2');
		$parent = new ViewModel();
		$parent->addChild($child1, 'child1');
		$parent->addChild($child2, 'child2');
		return $parent;
	}
    public function nolayoutAction()
    {
		$child1 = new ViewModel();
		$child1->setTemplate('demo/index/child1');
		$child2 = new ViewModel();
		$child2->setTemplate('demo/index/child2');
		$parent = new ViewModel();
		$parent->addChild($child1, 'child1');
		$parent->addChild($child2, 'child2');
		$parent->setTemplate('demo/index/parent');
		$parent->setTerminal(TRUE);
		return $parent;
	}
	public function jsonAction()
	{
		$data = [
			'numbers' => range(1, 6),
			'letters' => range('A','F')
		];
		$viewModel = new ViewModel(['data' => $data]);
		$viewModel->setTerminal(TRUE);
		return $viewModel;
	}
	public function jsonModelAction()
	{
		$data = [
			'numbers' => range(1, 6),
			'letters' => range('A','F')
		];
		$jsonModel = new JsonModel(['data' => $data]);
		return $jsonModel;
	}
	public function partialAction()
	{
		$viewModel = new ViewModel();
		return $viewModel;
	}
}
