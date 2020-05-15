<?php
declare(strict_types=1);
namespace Market\Controller;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;
use Laminas\Form\Form;
class PostController extends AbstractActionController
{
	protected $form = '';
	public function __construct(Form $form)
	{
		$this->form = $form;
	}
    public function indexAction()
    {
        return new ViewModel(['postForm' => $this->form]);
    }
}
