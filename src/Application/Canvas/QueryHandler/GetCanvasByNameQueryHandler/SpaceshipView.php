<?php

namespace Witrac\Application\Canvas\QueryHandler\GetCanvasByNameQueryHandler;

class SpaceshipView
{
    const KEY_X = 'x';
    const KEY_Y = 'y';

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
            self::KEY_X => $this->x,
            self::KEY_Y => $this->y
        ];
    }


}