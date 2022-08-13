<?php

namespace Witrac\Application\Canvas\QueryHandler\GetCanvasByNameQueryHandler;

use Witrac\Application\Canvas\Query\GetCanvasByName;
use Witrac\Domain\Canvas\Repository\CanvasRepository;
use Witrac\Domain\Shared\Bus\Query\QueryHandler;

class GetCanvasByNameQueryHandler implements QueryHandler
{

    public function __construct(
        private CanvasRepository $canvasRepository
    )
    {
    }

    public function __invoke(GetCanvasByName $query): ?GetCanvasByNameQueryView
    {
        $canvas = $this->canvasRepository->findByName($query->name());

        if(!$canvas){
            return null;
        }

        return new GetCanvasByNameQueryView(
            $canvas->name(),
            $canvas->width(),
            $canvas->height(),
            new SpaceshipView(
                $canvas->spaceship()->positionX(),
                $canvas->spaceship()->positionY()
            ),
            $canvas->blocks()
        );
    }

}