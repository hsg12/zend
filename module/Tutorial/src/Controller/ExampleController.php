<?php

namespace Tutorial\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Controller\IndexController;

class ExampleController extends AbstractActionController
{
    public function indexAction()
    {
        if ($this->request->isPost()) {
            $this->prg();
        }

        return new ViewModel();
    }

    public function sampleAction()
    {



        //return $this->forward()->dispatch(IndexController::class, ['action' => 'index']);

        //return $this->redirect()->toUrl('http://rambler.ru');

        //$this->layout('layout/defaultLayout');

        #$successMessage = 'Success message';
        #$this->flashMessenger()->addSuccessMessage($successMessage);

        #$errorMessage = 'Error message';
        #$this->flashMessenger()->addErrorMessage($errorMessage);

        #return $this->redirect()->toRoute('tutorial/example');

        $data = '<p><a href="#">Hello</a></p>';
        $num = 'Hello';

        $widget = $this->forward()->dispatch(IndexController::class, ['action' => 'index']);

        $view = new ViewModel([
            'url'  => $this->url()->fromRoute(),
            'data' => $this->clearData()->clearStr($data),
            'num' => $this->clearData()->clearInt($num),
        ]);
        //$view->addChild($widget, 'widget');
        //$view->setTemplate('tutorial/example/exampleTemplate');
        return $view;
    }

    public function page1Action()
    {
        return new ViewModel();
    }

    public function page2Action()
    {
        return new ViewModel();
    }
}
