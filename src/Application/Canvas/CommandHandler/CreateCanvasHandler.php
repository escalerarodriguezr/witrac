<?php
declare(strict_types=1);

namespace Witrac\Application\Canvas\CommandHandler;

use Witrac\Application\Canvas\Command\CreateCanvas;
use Witrac\Domain\Canvas\Model\Entity\Canvas;
use Witrac\Domain\Canvas\Repository\CanvasRepository;
use Witrac\Domain\Shared\Bus\Command\CommandHandler;
use Witrac\Domain\Shared\Service\IdentifierGenerator\IdentifierGenerator;
use Witrac\Domain\Spaceship\Model\Entity\Spaceship;
use Witrac\Domain\Spaceship\Repository\SpaceShipRepository;

class CreateCanvasHandler implements CommandHandler
{


    public function __construct(
        private IdentifierGenerator $identifierGenerator,
        private SpaceShipRepository $spaceShipRepository,
        private CanvasRepository $canvasRepository
    )
    {
    }

    public function __invoke(CreateCanvas $createCanvas): void
    {

        $this->canvasRepository->deleteByName($createCanvas->name());

        $spaceShip = new Spaceship(
            $this->identifierGenerator->uuid(),
            0,
            0
        );
        $this->spaceShipRepository->save($spaceShip);

        $canvas = new Canvas(
            $this->identifierGenerator->uuid(),
            $createCanvas->name(),
            $createCanvas->width(),
            $createCanvas->height(),
            $spaceShip
        );

        $this->canvasRepository->save($canvas);

    }


}