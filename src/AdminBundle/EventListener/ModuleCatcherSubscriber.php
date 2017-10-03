<?php

namespace AdminBundle\EventListener;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class ModuleCatcherSubscriber implements EventSubscriberInterface
{
    private $twig;

    public function __construct(\Twig_Environment $twig)
    {
        $this->twig = $twig;
    }

    public static function getSubscribedEvents()
    {
        return array(
            KernelEvents::CONTROLLER => "onController"
        );
    }

    public function onController(FilterControllerEvent $event)
    {
        $controller = $event->getController()[0];

        if (property_exists(get_class($controller), 'module')) {
            $this->twig->addGlobal('module', $controller->module);
        }
    }
}