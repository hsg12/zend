<?php

namespace Tutorial\Service;

use Tutorial\Service\GreetingServiceInterface;
use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\Event;

class GreetingService implements GreetingServiceInterface
{
    public $eventManager;

    public function getGreeting()
    {
        $output = '';
        $dt = new \DateTime();
        $dt->setTimezone(new \DateTimeZone('America/New_York'));
        $hour = $dt->format('H');

        $this->getEventManager()->setIdentifiers(['getGreetingIdentifier']);
        $this->getEventManager()->trigger('getGreeting', false, ['hour' => $hour]);

        /*$event = new Event();
        $event->setName(__FUNCTION__);
        $event->setParams(['hour' => $hour]);
        $this->getEventManager()->triggerEvent($event);*/

        if ($hour > 5 && $hour <= 11) {
            $output = 'Good morning, world!';
        } elseif ($hour > 11 && $hour <= 17) {
            $output = 'Good day, world!';
        } elseif ($hour > 17 && $hour <= 23) {
            $output = 'Good evening, world!';
        } else {
            $output = 'Good night, world!';
        }

        return $output;
    }

    public function setEventManager(EventManagerInterface $eventManager)
    {
        $this->eventManager = $eventManager;
    }

    public function getEventManager()
    {
        return $this->eventManager;
    }
}
