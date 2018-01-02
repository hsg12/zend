<?php

namespace Tutorial\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class ArticleController extends AbstractActionController
{
    public function indexAction()
    {
        return new ViewModel();
    }

    public function addAction()
    {
        return new ViewModel();
    }

    public function addPostAction()
    {
        $request = $this->getRequest();
        if ($request->isPost()) {
            $title = $this->clearData()->clearStr($request->getPost('title'));

            if (! empty($title)) {
                $message = 'The article successfully added';
                $this->flashMessenger()->addSuccessMessage($message);
            } else {
                $message = 'The article not added';
                $this->flashMessenger()->addErrorMessage($message);
            }

            return $this->redirect()->toRoute('tutorial/article');
        }
    }

    public function editAction()
    {
        return new ViewModel();
    }

    public function editPostAction()
    {
        $request = $this->getRequest();
        if ($request->isPost()) {
            $title = $this->clearData()->clearStr($request->getPost('title'));

            if (! empty($title)) {
                $message = 'The article successfully edited';
                $this->flashMessenger()->addSuccessMessage($message);
            } else {
                $message = 'The article not edited';
                $this->flashMessenger()->addErrorMessage($message);
            }

            return $this->redirect()->toRoute('tutorial/article');
        }
    }
}
