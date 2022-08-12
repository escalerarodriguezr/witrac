<?php

namespace Witrac\Application\Canvas\QueryHandler\GetCanvasByNameQueryHandler;

class SpaceshipView
{

    public function __construct(
        private int $x,
        private int $y
    )
    {
    }

    public function x(): int
    {
        return $this->x;
    }

    public function y(): int
    {
        return $this->y;
    }

    public function toArray(): array
    {
        return [
            'x' => $this->x,
            'y' => $this->y
        ];
    }


}