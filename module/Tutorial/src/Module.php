<?php

namespace Tutorial;

use Zend\ModuleManager\ModuleManager;
use Zend\Mvc\MvcEvent;

class Module
{
    const VERSION = '3.0.3-dev';

    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }

    public function getServiceConfig()
    {
        return [
            'invokables' => [
                'someEventService' => Service\SomeEventService::class,
            ],
            'factories' => [
                'greetingService'   => Service\GreetingServiceFactory::class,
                'greetingAggregate' => Event\GreetingServiceListenerAggregateFactory::class,
            ],
        ];
    }

    public function getControllerConfig()
    {
        return [
            'factories' => [
                Controller\IndexController::class => function ($container) {
                    $ctr = new Controller\IndexController();
                    $ctr->setGreetingService($container->get('greetingService'));
                    return $ctr;
                },
            ],
        ];
    }

    public function getControllerPluginConfig()
    {
        return [
            'invokables' => [
                'clearData' => Controller\Plugin\ClearData::class,
            ],
        ];
    }

    public function getViewHelperConfig()
    {
        return [
            'invokables' => [
                'getDateTime' => View\Helper\GetDateTime::class,
            ],
        ];
    }

    /*public function init(ModuleManager $moduleManager)
    {
        $moduleManager->getEventManager()->getSharedManager()->attach(
            __NAMESPACE__,
            'dispatch',
            [$this, 'onInit']
        );
    }

    public function onInit()
    {
        echo __METHOD__;
    }*/

    /*public function onBootstrap(MvcEvent $mvcEvent)
    {
        $mvcEvent->getApplication()->getEventManager()->getSharedManager()->attach(
            __NAMESPACE__,
            'dispatch',
            function ($e) {
                $controller = $e->getTarget();
                $controller->layout('layout/defaultLayout');
            },
            100
        );
    }*/
}
