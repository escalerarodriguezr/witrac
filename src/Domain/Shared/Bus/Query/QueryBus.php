<?php

namespace Witrac\Domain\Shared\Bus\Query;

interface QueryBus
{
    public function handle(Query $query): mixed;
}