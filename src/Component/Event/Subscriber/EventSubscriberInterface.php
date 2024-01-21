<?php
declare(strict_types=1);

namespace Laventure\Component\Event\Subscriber;


/**
 * EventSubscriberInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Event\Subscriber
 */
interface EventSubscriberInterface
{
    /**
     * Returns subscribed events
     *
     * @return array
    */
    public function getSubscribedEvents(): array;
}