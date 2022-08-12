<?php
declare(strict_types=1);

namespace App\Controller\Spaceship;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Witrac\Application\Canvas\Query\GetCanvasByName;
use Witrac\Application\Spaceship\Command\SpaceshipMoveLeft;
use Witrac\Domain\Shared\Bus\Command\CommandBus;
use Witrac\Domain\Shared\Bus\Query\QueryBus;

class SpaceshipMoveLeftController
{

    public function __construct(
        private CommandBus $commandBus,
        private QueryBus $queryBus
    )
    {
    }

    public function __invoke(string $canvasName):Response
    {

        $this->commandBus->dispatch(new SpaceshipMoveLeft($canvasName));
        $canvasView = $this->queryBus->handle(
            new GetCanvasByName($canvasName)
        );

        return new JsonResponse([
            'status' => 'moved',
            'canvas' => $canvasView->toArray()
        ], Response::HTTP_OK);

    }

}
