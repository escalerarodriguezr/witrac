<?php
declare(strict_types=1);

namespace Witrac\Domain\Spaceship\Model\Entity;

class Spaceship
{
    private string $uuid;
    private int $positionX;
    private int $positionY;

    public function __construct(string $uuid, int $positionX, int $positionY)
    {
        $this->uuid = $uuid;
        $this->positionX = $positionX;
        $this->positionY = $positionY;
    }


    public function uuid(): string
    {
        return $this->uuid;
    }


    public function positionX(): int
    {
        return $this->positionX;
    }


    public function positionY(): int
    {
        return $this->positionY;
    }


}