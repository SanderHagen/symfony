<?php

namespace Symfony\Component\Messenger\Tests\EventListener;

use PHPUnit\Framework\TestCase;
use Symfony\Component\Messenger\Event\WorkerStoppedEvent;
use Symfony\Component\Messenger\EventListener\ResetConnectionOnWorkerStopListener;
use Symfony\Component\Messenger\Worker;
use Symfony\Contracts\Service\ResetInterface;

class ResetConnectionOnWorkerStopListenerTest extends TestCase
{
    public function testReceiverResetIfResettable()
    {
        $resettableReceiver = $this->createMock(ResetInterface::class);
        $resettableReceiver->expects($this->once())->method('reset');

        $worker = $this->createMock(Worker::class);

        $event = new WorkerStoppedEvent($worker, [$resettableReceiver]);

        $listener = new ResetConnectionOnWorkerStopListener();
        $listener->onWorkerStopped($event);
    }
}