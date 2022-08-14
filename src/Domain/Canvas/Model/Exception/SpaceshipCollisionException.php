<?php
declare(strict_types=1);

namespace Witrac\Domain\Canvas\Model\Exception;

use Witrac\Domain\Canvas\Model\Entity\Block;

class SpaceshipCollisionException extends \DomainException
{
    public static function whithBlock(Block $block): self
    {
        throw new self(\sprintf('Movement not allowed due to collision with block in x = %d and y = %d',
            $block->positionX(),$block->positionY()
        ));
    }
}