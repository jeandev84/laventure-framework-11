<?php
declare(strict_types=1);

namespace Laventure\Component\Event\Dispatcher;

use Psr\EventDispatcher\EventDispatcherInterface;
use Psr\EventDispatcher\ListenerProviderInterface;
use Psr\EventDispatcher\StoppableEventInterface;

/**
 * EventDispatcher
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Event\Dispatcher
 */
class EventDispatcher implements EventDispatcherInterface
{


    /**
     * @param ListenerProviderInterface $listenerProvider
    */
    public function __construct(protected ListenerProviderInterface $listenerProvider)
    {
    }



    /**
     * @inheritDoc
    */
    public function dispatch(object $event)
    {
        if ($event instanceof StoppableEventInterface && $event->isPropagationStopped()) {
            return $event;
        }

        foreach ($this->listenerProvider->getListenersForEvent($event) as $listener) {
            $listener($event);
        }

        return $event;
    }
}