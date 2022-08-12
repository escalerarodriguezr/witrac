<?php

namespace Witrac\Application\Canvas\QueryHandler\GetCanvasByNameQueryHandler;

use function Symfony\Component\DependencyInjection\Loader\Configurator\service_locator;

class GetCanvasByNameQueryView
{
    const KEY_NAME = 'name';
    const KEY_WIDTH = 'width';
    const KEY_HEIGHT = 'height';
    const KEY_SPACESHIP = 'spaceship';

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
            self::KEY_NAME=> $this->name,
            self::KEY_WIDTH => $this->width,
            self::KEY_HEIGHT => $this->heigt,
            self::KEY_SPACESHIP => $this->spaceshipView->toArray()
        ];
    }
}