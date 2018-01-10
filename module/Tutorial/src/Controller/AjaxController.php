<?php

namespace Tutorial\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class AjaxController extends AbstractActionController
{
    public function indexAction()
    {
        return new ViewModel();
    }

    public function manageAction()
    {
        $response = $this->getResponse();
        $request  = $this->getRequest();

        if ($request->isPost()) {
            $firstName = $this->clearData()->clearStr($request->getPost('firstName'));
            $lastName  = $this->clearData()->clearStr($request->getPost('lastName'));

            if (! empty($firstName) && ! empty($lastName)) {
                $output = 'Hello ' . $firstName . ' ' . $lastName;
            } else {
                $output = 'Empty request';
            }
        }

        $response->setContent(\Zend\Json\Json::encode($output));
        return $response;
    }
}
