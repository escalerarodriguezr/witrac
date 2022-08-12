<?php
declare(strict_types=1);

namespace Witrac\Infrastructure\Persistence\IdentifierGenerator;

use Symfony\Component\Uid\Uuid;
use Witrac\Domain\Shared\Service\IdentifierGenerator\IdentifierGenerator;

final class UuidIdentifierGenerator implements IdentifierGenerator
{

    public function uuid(): string
    {
        return Uuid::v4()->toRfc4122();
    }

}