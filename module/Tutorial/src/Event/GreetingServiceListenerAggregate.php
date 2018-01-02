<?php

namespace Tutorial\Event;

use Zend\EventManager\ListenerAggregateInterface;
use Zend\EventManager\EventManagerInterface;
use Tutorial\Service\SomeEventServiceInterface;
use Zend\EventManager\Event;

class GreetingServiceListenerAggregate implements ListenerAggregateInterface
{
    private $someEventService;
    private $listeners = [];

    public function attach(EventManagerInterface $events, $priority = 1)
    {
        $this->listeners[] = $events->attach('getGreeting', [$this, 'listener1'], $priority);
        $this->listeners[] = $events->attach('getGreeting', [$this, 'listener2'], $priority);
        $this->listeners[] = $events->attach('getGreeting', [$this, 'listener3'], $priority);
    }

    public function detach(EventManagerInterface $events){
        foreach ($this->listeners as $index => $listener) {
            $events->detach($listener);
            unsest($listener[$index]);
        }
    }

    public function setSomeEventService(SomeEventServiceInterface $someEventService)
    {
        $this->someEventService = $someEventService;
    }

    public function getSomeEventService()
    {
        return $this->someEventService;
    }

    public function listener1(Event $event)
    {
        $params = $event->getParams();
        $this->getSomeEventService()->onGetGreeting($params);
    }

    public function listener2(Event $event)
    {
        $params = $event->getParams();
        $this->getSomeEventService()->onGetGreeting($params);
    }

    public function listener3(Event $event)
    {
        $params = $event->getParams();
        $this->getSomeEventService()->onGetGreeting($params);
    }
}
