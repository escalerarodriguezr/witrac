<?php
declare(strict_types=1);

namespace PHPUnit\Tests\Unit\Domain\Spaceship\Model\Entity;

use PHPUnit\Framework\TestCase;
use Witrac\Domain\Canvas\Model\Entity\Canvas;
use Witrac\Domain\Spaceship\Model\Entity\Spaceship;

class SpaceshipMoveBottomIntoCanvasTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    public function testMoveBottomFromBottomLimit()
    {
        $spaceship = new Spaceship(
            'e6ce50ae-24c5-48ac-89bb-b64bfb8fd2ec',
            0,
            4
        );

        $canvas = new Canvas(
            'e6ce50ae-24c5-48ac-89bb-b64bfb8fd2ee',
            'canvas_name',
            4,
            4,
            $spaceship
        );

        $spaceship->moveBottomIntoCanvas($canvas);
        self::assertEquals(0,$spaceship->positionY());
        self::assertEquals(0,$spaceship->positionX());
    }


    public function testMoveBottomFromTopLimit()
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

        $spaceship->moveBottomIntoCanvas($canvas);
        self::assertEquals(1,$spaceship->positionY());
        self::assertEquals(0,$spaceship->positionX());
    }

    public function testMoveBottomFromNotBoundaryCondition()
    {
        $spaceship = new Spaceship(
            'e6ce50ae-24c5-48ac-89bb-b64bfb8fd2ec',
            0,
            2
        );

        $canvas = new Canvas(
            'e6ce50ae-24c5-48ac-89bb-b64bfb8fd2ee',
            'canvas_name',
            4,
            4,
            $spaceship
        );

        $spaceship->moveBottomIntoCanvas($canvas);
        self::assertEquals(3,$spaceship->positionY());
        self::assertEquals(0,$spaceship->positionX());
    }

}