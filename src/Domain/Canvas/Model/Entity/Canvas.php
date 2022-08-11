<?php
declare(strict_types=1);

namespace Witrac\Domain\Canvas\Model\Entity;

use Witrac\Domain\Spaceship\Model\Entity\Spaceship;

class Canvas
{
    private string $id;
    private string $name;
    private int $width;
    private int $height;
    private Spaceship $spaceship;

    public function __construct(
        string $id,
        string $name,
        int $width,
        int $height,
        string $spaceshipUuid
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->width = $width;
        $this->height = $height;
        $this->spaceship = new Spaceship($spaceshipUuid,0,0);
    }

    public function id(): string
    {
        return $this->id;
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

    public function spaceship(): Spaceship
    {
        return $this->spaceship;
    }


}