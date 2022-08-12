<?php
declare(strict_types=1);

namespace Witrac\Application\Spaceship\CommandHandler;

use Witrac\Application\Spaceship\Command\SpaceshipMoveBottom;
use Witrac\Application\Spaceship\Command\SpaceshipMoveUp;
use Witrac\Domain\Canvas\Repository\CanvasRepository;
use Witrac\Domain\Shared\Bus\Command\CommandHandler;
use Witrac\Domain\Spaceship\Repository\SpaceShipRepository;

class SpaceshipMoveBottomHandler implements CommandHandler
{
    public function __construct(
        private CanvasRepository $canvasRepository,
        private SpaceShipRepository $spaceShipRepository
    )
    {
    }

    public function __invoke(SpaceshipMoveBottom $spaceshipMoveBottom): void
    {
        $canvas = $this->canvasRepository->findByNameOrFail($spaceshipMoveBottom->canvasName());
        $spaceship = $canvas->spaceship();
        $spaceship->moveBottomIntoCanvas($canvas);
        $this->spaceShipRepository->save($spaceship);
    }

}