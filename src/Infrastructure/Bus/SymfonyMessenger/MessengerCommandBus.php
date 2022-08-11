<?php
declare(strict_types=1);

namespace Witrac\Infrastructure\Bus\SymfonyMessenger;

use Symfony\Component\Messenger\MessageBusInterface;
use Witrac\Domain\Shared\Bus\Command\Command;
use Witrac\Domain\Shared\Bus\Command\CommandBus;

final class MessengerCommandBus implements CommandBus
{
    private MessageBusInterface $commandBus;

    public function __construct(MessageBusInterface $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    public function dispatch(Command $command): void
    {
        $this->commandBus->dispatch($command);
    }


}