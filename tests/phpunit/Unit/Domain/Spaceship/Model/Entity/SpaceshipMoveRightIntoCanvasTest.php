<?php
declare(strict_types=1);

namespace PHPUnit\Tests\Unit\Domain\Spaceship\Model\Entity;

use PHPUnit\Framework\TestCase;
use Witrac\Domain\Canvas\Model\Entity\Canvas;
use Witrac\Domain\Spaceship\Model\Entity\Spaceship;

class SpaceshipMoveRightIntoCanvasTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    public function testMoveRightFromLeftLimit()
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

        $spaceship->moveRightIntoCanvas($canvas);
        self::assertEquals(0,$spaceship->positionY());
        self::assertEquals(1,$spaceship->positionX());
    }


    public function testMoveRightFromRightLimit()
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

        $spaceship->moveRightIntoCanvas($canvas);
        self::assertEquals(0,$spaceship->positionY());
        self::assertEquals(0,$spaceship->positionX());
    }

    public function testMoveRightFromNotBoundaryCondition()
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

        $spaceship->moveRightIntoCanvas($canvas);
        self::assertEquals(0,$spaceship->positionY());
        self::assertEquals(3,$spaceship->positionX());
    }

}