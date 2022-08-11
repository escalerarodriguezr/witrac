<?php
declare(strict_types=1);

namespace Witrac\Domain\Spaceship\Model\Entity;

class Spaceship
{
    private string $id;
    private string $name;
    private int $positionX;
    private int $positionY;

    public function __construct(string $id,string $name, int $positionX, int $positionY)
    {
        $this->id = $id;
        $this->name = $name;
        $this->positionX = $positionX;
        $this->positionY = $positionY;
    }


    public function id(): string
    {
        return $this->id;
    }


    public function name(): string
    {
        return $this->name;
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