<?php
declare(strict_types=1);

namespace App\Controller\Canvas;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Witrac\Application\Canvas\Command\CreateCanvas;
use Witrac\Domain\Shared\Bus\Command\CommandBus;
use Witrac\Infrastructure\Ui\Http\Request\DTO\CreateCanvasRequest;

class CreateCanvasController
{

    private CommandBus $commandBus;

    public function __construct(
        CommandBus $commandBus
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
        return new JsonResponse(null,Response::HTTP_CREATED);


    }


}