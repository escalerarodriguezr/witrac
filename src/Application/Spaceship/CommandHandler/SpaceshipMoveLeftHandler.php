<?php
declare(strict_types=1);

namespace Witrac\Application\Spaceship\CommandHandler;

use Witrac\Application\Spaceship\Command\SpaceshipMoveLeft;
use Witrac\Domain\Canvas\Repository\CanvasRepository;
use Witrac\Domain\Shared\Bus\Command\CommandHandler;
use Witrac\Domain\Spaceship\Repository\SpaceShipRepository;

class SpaceshipMoveLeftHandler implements CommandHandler
{
    public function __construct(
        private CanvasRepository $canvasRepository,
        private SpaceShipRepository $spaceShipRepository
    )
    {
    }

    public function __invoke(SpaceshipMoveLeft $spaceshipMoveLeft): void
    {
        $canvas = $this->canvasRepository->findByNameOrFail($spaceshipMoveLeft->canvasName());
        $spaceship = $canvas->spaceship();
        $spaceship->moveLeftIntoCanvas($canvas);
        $this->spaceShipRepository->save($spaceship);
    }

}