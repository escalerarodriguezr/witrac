<?php
declare(strict_types=1);

namespace Witrac\Application\Spaceship\CommandHandler;

use Witrac\Application\Spaceship\Command\SpaceshipMoveUp;
use Witrac\Domain\Canvas\Repository\CanvasRepository;
use Witrac\Domain\Shared\Bus\Command\CommandHandler;
use Witrac\Domain\Spaceship\Repository\SpaceShipRepository;

class SpaceshipMoveUpHandler implements CommandHandler
{
    public function __construct(
        private CanvasRepository $canvasRepository,
        private SpaceShipRepository $spaceShipRepository
    )
    {
    }

    public function __invoke(SpaceshipMoveUp $spaceshipMoveUp): void
    {
        $canvas = $this->canvasRepository->findByNameOrFail($spaceshipMoveUp->canvasName());
        $spaceship = $canvas->spaceship();
        $spaceship->moveUpIntoCanvas($canvas);
        $canvas->checkSpaceshipCollision($spaceship);
        $this->spaceShipRepository->save($spaceship);
    }

}