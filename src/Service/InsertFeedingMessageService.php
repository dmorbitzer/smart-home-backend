<?php

namespace App\Service;

use App\Message\CatFeedingServiceMessage;
use Symfony\Component\Messenger\MessageBusInterface;

class InsertFeedingMessageService implements InsertFeedingMessageServiceInterface
{
    /** @var MessageBusInterface  */
    private MessageBusInterface $bus;

    /**
     * @param MessageBusInterface $bus
     */
    public function __construct(MessageBusInterface $bus)
    {
        $this->bus = $bus;
    }

    public function insert(int $catId, int $foodId, string $type)
    {
        $catFeedMessage = new CatFeedingServiceMessage($catId, $foodId, $type);
        $this->bus->dispatch($catFeedMessage);
    }
}
