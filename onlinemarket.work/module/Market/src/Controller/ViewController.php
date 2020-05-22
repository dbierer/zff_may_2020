<?php
declare(strict_types=1);
namespace Market\Controller;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;
class ViewController extends AbstractActionController
{
	use ListingsTableTrait;
    public function indexAction()
    {
		$category = $this->params()->fromRoute('category', 'free');
		$list = $this->table->findByCategory($category);
        return new ViewModel(['list' => $list, 'category' => $category]);
    }
}
