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
        $data = [];
        $message = 'Please enter appropriate form data';
        if ($this->getRequest()->isPost()) {
            $this->form->setData($this->params()->fromPost());
            if ($this->form->isValid()) {
                $message = 'SUCCESS: form data is valid';
                $data = $form->getData();
            } else {
                $message = 'ERROR: form data failed validation';
            }
        }
        return new ViewModel(['postForm' => $this->form, 'message' => $message, 'data' => $data]);
    }
}
