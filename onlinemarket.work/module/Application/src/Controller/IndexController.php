<?php

/**
 * @see       https://github.com/laminas/laminas-mvc-skeleton for the canonical source repository
 * @copyright https://github.com/laminas/laminas-mvc-skeleton/blob/master/COPYRIGHT.md
 * @license   https://github.com/laminas/laminas-mvc-skeleton/blob/master/LICENSE.md New BSD License
 */

declare(strict_types=1);

namespace Application\Controller;

use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        return new ViewModel();
    }
    public function testAction()
    {
		$nameFromGet = $this->params()->fromQuery('name_get', 'From GET');
		$nameFromRoute = $this->params()->fromRoute('name_route', 'From ROUTE');
        return new ViewModel(['nameFromGet' => $nameFromGet, 'nameFromRoute' => $nameFromRoute]);
    }
}
