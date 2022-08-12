<?php

namespace Witrac\Application\Canvas\QueryHandler\GetCanvasByNameQueryHandler;

class GetCanvasByNameQueryView
{
    public function __construct(
        private string $name,
        private int $width,
        private int $heigt,
        private SpaceshipView $spaceshipView

    )
    {
    }

    public function name(): string
    {
        return $this->name;
    }

    public function width(): int
    {
        return $this->width;
    }

    public function heigt(): int
    {
        return $this->heigt;
    }

    public function spaceshipView(): SpaceshipView
    {
        return $this->spaceshipView;
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'width' => $this->width,
            'height' => $this->heigt,
            'spaceship' => $this->spaceshipView->toArray()
        ];
    }
}