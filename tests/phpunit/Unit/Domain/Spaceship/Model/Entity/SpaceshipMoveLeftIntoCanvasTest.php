<?php
declare(strict_types=1);

namespace PHPUnit\Tests\Unit\Domain\Spaceship\Model\Entity;

use PHPUnit\Framework\TestCase;
use Witrac\Domain\Canvas\Model\Entity\Canvas;
use Witrac\Domain\Spaceship\Model\Entity\Spaceship;

class SpaceshipMoveLeftIntoCanvasTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    public function testMoveLeftFromLeftLimit()
    {
        $spaceship = new Spaceship(
            'e6ce50ae-24c5-48ac-89bb-b64bfb8fd2ec',
            0,
            0
        );

        $canvas = new Canvas(
            'e6ce50ae-24c5-48ac-89bb-b64bfb8fd2ee',
            'canvas_name',
            4,
            4,
            $spaceship
        );

        $spaceship->moveLeftIntoCanvas($canvas);
        self::assertEquals(0,$spaceship->positionY());
        self::assertEquals(4,$spaceship->positionX());
    }


    public function testMoveLeftFromRightLimit()
    {
        $spaceship = new Spaceship(
            'e6ce50ae-24c5-48ac-89bb-b64bfb8fd2ec',
            4,
            0
        );

        $canvas = new Canvas(
            'e6ce50ae-24c5-48ac-89bb-b64bfb8fd2ee',
            'canvas_name',
            4,
            4,
            $spaceship
        );

        $spaceship->moveLeftIntoCanvas($canvas);
        self::assertEquals(0,$spaceship->positionY());
        self::assertEquals(3,$spaceship->positionX());
    }

    public function testMoveLeftFromNotBoundaryCondition()
    {
        $spaceship = new Spaceship(
            'e6ce50ae-24c5-48ac-89bb-b64bfb8fd2ec',
            2,
            0
        );

        $canvas = new Canvas(
            'e6ce50ae-24c5-48ac-89bb-b64bfb8fd2ee',
            'canvas_name',
            4,
            4,
            $spaceship
        );

        $spaceship->moveLeftIntoCanvas($canvas);
        self::assertEquals(0,$spaceship->positionY());
        self::assertEquals(1,$spaceship->positionX());
    }

}