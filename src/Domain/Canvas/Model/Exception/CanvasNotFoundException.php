<?php
declare(strict_types=1);

namespace Witrac\Domain\Canvas\Model\Exception;

class CanvasNotFoundException extends \DomainException
{
    public static function fromName(string $name): self
    {
        throw new self(\sprintf('Missing Canvas "%s"', $name));
    }

}