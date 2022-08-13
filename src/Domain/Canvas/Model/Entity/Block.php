<?php
declare(strict_types=1);

namespace Witrac\Domain\Canvas\Model\Entity;

class Block
{
    private string $id;
    private int $positionX;
    private int $positionY;
    private Canvas $canvas;

    public function __construct(string $id, int $positionX, int $positionY, Canvas $canvas)
    {
        $this->id = $id;
        $this->positionX = $positionX;
        $this->positionY = $positionY;
        $this->canvas = $canvas;
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

    public function canvas(): Canvas
    {
        return $this->canvas;
    }


}