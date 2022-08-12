<?php
declare(strict_types=1);

namespace Witrac\Application\Spaceship\Command;

use Witrac\Domain\Shared\Bus\Command\Command;

class SpaceshipMoveLeft implements Command
{

    public function __construct(
        private string $canvasName
    )
    {
    }

    public function canvasName(): string
    {
        return $this->canvasName;
    }

}