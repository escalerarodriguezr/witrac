<?php
declare(strict_types=1);

namespace App\Controller\Canvas;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Witrac\Application\Canvas\Command\CreateCanvas;
use Witrac\Application\Canvas\Query\GetCanvasByName;
use Witrac\Domain\Shared\Bus\Command\CommandBus;
use Witrac\Domain\Shared\Bus\Query\QueryBus;
use Witrac\Infrastructure\Ui\Http\Request\DTO\CreateCanvasRequest;

class CreateCanvasController
{


    public function __construct(
        private CommandBus $commandBus,
        private QueryBus $queryBus
    )
    {
        $this->commandBus = $commandBus;
    }

    public function __invoke(CreateCanvasRequest $request):Response
    {

        $this->commandBus->dispatch(
            new CreateCanvas(
                $request->getName(),
                $request->getWidth(),
                $request->getHeight(),
            )
        );

        $canvasView = $this->queryBus->handle(
            new GetCanvasByName($request->getName())
        );

        return new JsonResponse([
            'status' => 'created',
            'canvas' => $canvasView->toArray()
        ], Response::HTTP_CREATED);

    }

}