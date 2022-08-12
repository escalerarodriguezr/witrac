<?php
declare(strict_types=1);

namespace Witrac\Domain\Spaceship\Model\Entity;

use Witrac\Domain\Canvas\Model\Entity\Canvas;

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

    public function moveUpIntoCanvas(Canvas $canvas): void
    {
        --$this->positionY;
        if( $this->positionY < 0 ){
            $this->positionY = $canvas->height();
        }
    }

    public function moveBottomIntoCanvas(Canvas $canvas): void
    {
        ++$this->positionY;
        if( $this->positionY > $canvas->height() ){
            $this->positionY = 0;
        }
    }

    public function moveRightIntoCanvas(Canvas $canvas): void
    {
        ++$this->positionX;
        if( $this->positionX > $canvas->width() ){
            $this->positionX = 0;
        }
    }

    public function moveLeftIntoCanvas(Canvas $canvas): void
    {
        --$this->positionX;
        if( $this->positionX < 0 ){
            $this->positionX = $canvas->width();
        }

    }

}