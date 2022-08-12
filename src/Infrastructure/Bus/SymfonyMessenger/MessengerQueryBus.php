<?php
declare(strict_types=1);

namespace Witrac\Infrastructure\Bus\SymfonyMessenger;

use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;
use Witrac\Domain\Shared\Bus\Query\QueryBus;
use Witrac\Domain\Shared\Bus\Query\Query;

final class MessengerQueryBus implements QueryBus
{
    use HandleTrait {
        handle as handleQuery;
    }

    public function __construct(MessageBusInterface $queryBus)
    {
        $this->messageBus = $queryBus;
    }


    public function handle(Query $query): mixed
    {
        return $this->handleQuery($query);
    }

}