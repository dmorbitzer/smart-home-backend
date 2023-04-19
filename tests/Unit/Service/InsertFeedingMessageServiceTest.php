<?php

namespace App\Tests\Unit\Service;

use App\Message\CatFeedingServiceMessage;
use App\Service\InsertFeedingMessageService;
use App\Service\InsertFeedingMessageServiceInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\MessageBusInterface;

class InsertFeedingMessageServiceTest extends TestCase
{
    /** @var InsertFeedingMessageService  */
    private InsertFeedingMessageService $instance;

    /** @var MessageBusInterface|MockObject|null  */
    private ?MessageBusInterface $messageBusMock = null;

    protected function setUp(): void
    {
        parent::setUp();
        $this->messageBusMock = $this->createMock(MessageBusInterface::class);
        $this->instance = new InsertFeedingMessageService($this->messageBusMock);
    }

    public function testInsertMessageIntoQueue(): void
    {
        $messageQueuePipe = [];
        $this->messageBusMock->method('dispatch')->willReturnCallback(
            function (CatFeedingServiceMessage $message) use (&$messageQueuePipe) {
                $messageQueuePipe[] = $message;
                return new Envelope($message);
            }
        );

        $this->instance->insert(1, 2, InsertFeedingMessageServiceInterface::AUTOMATIC_MODE);
        $this->instance->insert(2, 2, InsertFeedingMessageServiceInterface::MANUELL_MODE);

        $this->assertCount(2, $messageQueuePipe);
        $this->assertEquals(1, $messageQueuePipe[0]->getCatId());
        $this->assertEquals(2, $messageQueuePipe[0]->getFoodId());
        $this->assertEquals(
            InsertFeedingMessageServiceInterface::AUTOMATIC_MODE,
            $messageQueuePipe[0]->getType()
        );

        $this->assertEquals(2, $messageQueuePipe[1]->getCatId());
        $this->assertEquals(2, $messageQueuePipe[1]->getFoodId());
        $this->assertEquals(
            InsertFeedingMessageServiceInterface::MANUELL_MODE,
            $messageQueuePipe[1]->getType()
        );
    }
}
