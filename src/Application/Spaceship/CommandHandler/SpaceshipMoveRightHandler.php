<?php
declare(strict_types=1);

namespace Witrac\Application\Spaceship\CommandHandler;

use Witrac\Application\Spaceship\Command\SpaceshipMoveRight;
use Witrac\Domain\Canvas\Repository\CanvasRepository;
use Witrac\Domain\Shared\Bus\Command\CommandHandler;
use Witrac\Domain\Spaceship\Repository\SpaceShipRepository;

class SpaceshipMoveRightHandler implements CommandHandler
{
    public function __construct(
        private CanvasRepository $canvasRepository,
        private SpaceShipRepository $spaceShipRepository
    )
    {
    }

    public function __invoke(SpaceshipMoveRight $spaceshipMoveRight): void
    {
        $canvas = $this->canvasRepository->findByNameOrFail($spaceshipMoveRight->canvasName());
        $spaceship = $canvas->spaceship();
        $spaceship->moveRightIntoCanvas($canvas);
        $canvas->checkSpaceshipCollision($spaceship);
        $this->spaceShipRepository->save($spaceship);
    }

}