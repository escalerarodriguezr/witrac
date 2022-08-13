<?php

namespace Witrac\Application\Canvas\QueryHandler\GetCanvasByNameQueryHandler;

use Doctrine\Common\Collections\Collection;
use Witrac\Domain\Canvas\Model\Entity\Block;
use function Symfony\Component\DependencyInjection\Loader\Configurator\service_locator;

class GetCanvasByNameQueryView
{
    const KEY_NAME = 'name';
    const KEY_WIDTH = 'width';
    const KEY_HEIGHT = 'height';
    const KEY_SPACESHIP = 'spaceship';
    const KEY_BLOCKS = 'blocks';
    const BLOCK_X = 'x';
    const BLOCK_Y = 'y';

    public function __construct(
        private string        $name,
        private int           $width,
        private int           $height,
        private SpaceshipView $spaceshipView,
        private Collection    $blocks

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

    public function height(): int
    {
        return $this->height;
    }

    public function spaceshipView(): SpaceshipView
    {
        return $this->spaceshipView;
    }

    public function getBlocks(): Collection
    {
        return $this->blocks;
    }

    private function transformBlocks(){

        if( $this->blocks->isEmpty() ){
            return [];
        }
        return array_map(function (Block $block): array {
            return [
                self::BLOCK_X => $block->positionX(),
                self::BLOCK_Y => $block->positionY()
            ];
        }, $this->blocks->toArray());

    }

    public function toArray(): array
    {
        return [
            self::KEY_NAME=> $this->name,
            self::KEY_WIDTH => $this->width,
            self::KEY_HEIGHT => $this->height,
            self::KEY_SPACESHIP => $this->spaceshipView->toArray(),
            self::KEY_BLOCKS => $this->transformBlocks(),
        ];
    }
}