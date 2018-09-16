<?php

namespace App\EventListeners;

use App\Entity\Log;
use Doctrine\Common\Persistence\ObjectManager;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\EventListener\RouterListener;
use Symfony\Component\Routing\Matcher\UrlMatcherInterface;
use Symfony\Component\Routing\RequestContext;

class CustomRouteListener extends RouterListener
{
    protected $manager;

    public function __construct(ObjectManager $objectManager, UrlMatcherInterface $matcher, RequestStack $requestStack, ?RequestContext $context = null, ?LoggerInterface $logger = null, string $projectDir = null, bool $debug = true)
    {
        parent::__construct($matcher, $requestStack, $context, $logger, $projectDir, $debug);
        $this->manager = $objectManager;
    }

    public function onKernelRequest(GetResponseEvent $event)
    {
        $request = $event->getRequest();

        if(false !== strpos($request->getRequestUri(), 'people'))
        {
            $log = new Log();

            $log->setEndpoint($request->getRequestUri());
            $log->setOperation($request->getMethod());
            $log->setTimestamp(new \DateTime());

            $this->manager->persist($log);
            $this->manager->flush();

            return;
        }

        return;
    }
}