<?php

namespace Tutorial\Controller;

use Zend\Http\Header\SetCookie;
use Zend\Http\Headers;
use Zend\Http\Response\Stream;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Session\Container;
use Zend\View\Model\ViewModel;
use Application\Controller\IndexController;

class ExampleController extends AbstractActionController
{
    public function indexAction()
    {
        $message = '';

        /*$container = new Container('sessMessage');
        $message = $container->message;
        $container->getManager()->getStorage()->clear('sessMessage');*/

        $cookie = $this->request->getCookie('cookieName');
        if ($cookie->offsetExists('cookieName')) {
            $message = $cookie->offsetGet('cookieName');

            $cookie = new setCookie('cookieName', '', time() - 3600, '/');
            $this->response->getHeaders()->addHeader($cookie);
        }

        if ($this->request->isPost()) {
            $this->prg();
        }

        return new ViewModel([
            'message' => $message,
        ]);
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

        /*$container = new Container('sessMessage');
        $container->message = 'Session message';*/

        $cookie = new SetCookie('cookieName', 'cookieValue', strtotime('1 month'), '/');
        $this->response->getHeaders()->addHeader($cookie);



        $view = new ViewModel([
            'url'  => $this->url()->fromRoute(),
            'data' => $this->clearData()->clearStr($data),
            'num' => $this->clearData()->clearInt($num),
        ]);
        //$view->addChild($widget, 'widget');
        //$view->setTemplate('tutorial/example/exampleTemplate');
        return $view;
    }

    public function downloadAction()
    {
        $file = 'robot3.jpg';
        $file = getcwd() . '/public_html/img/' . $file;

        if (is_file($file)) {
            $fileName = basename($file);
            $fileSize = filesize($file);

            $stream = new Stream();
            $stream->setStream(fopen($file, 'r'));
            $stream->setStreamName($fileName);
            $stream->setStatusCode(200);

            $headers = new Headers();
            $headers->addHeaderLine('Content-Type: application/octet-stream;');
            $headers->addHeaderLine('Content-Disposition: attachment; filename = ' . $fileName);
            $headers->addHeaderLine('Content-Length: ' . $fileSize);
            $headers->addHeaderLine('Cache-Control: no-cache, no-store, must-revalidate');

            $stream->setHeaders($headers);
            return $stream;
        }
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
