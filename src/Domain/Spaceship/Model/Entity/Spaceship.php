<?php
declare(strict_types=1);

namespace Witrac\Domain\Spaceship\Model\Entity;

class Spaceship
{
    private string $id;
    private int $positionX;
    private int $positionY;

    public function __construct(string $id, int $positionX, int $positionY)
    {
        $this->id = $id;
        $this->positionX = $positionX;
        $this->positionY = $positionY;
    }


    public function id(): string
    {
        return $this->id;
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