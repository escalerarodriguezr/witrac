<?php

namespace PHPUnit\Tests\Unit\Domain\Canvas\Model\Entity;

use PHPUnit\Framework\MockObject\MockBuilder;
use PHPUnit\Framework\TestCase;
use Witrac\Domain\Canvas\Model\Entity\Canvas;
use Witrac\Domain\Canvas\Model\Exception\SpaceshipCollisionException;
use Witrac\Domain\Shared\Service\IdentifierGenerator\IdentifierGenerator;
use Witrac\Domain\Spaceship\Model\Entity\Spaceship;

class CanvasCheckSpaceshipCollisionTest extends TestCase
{
    private MockBuilder|IdentifierGenerator $identifierGenerator;

    protected function setUp(): void
    {
        parent::setUp();

        $this->identifierGenerator = $this->getMockBuilder(IdentifierGenerator::class)
            ->disableOriginalConstructor()
            ->getMock();

    }

    public function testThrowSpaceshipCollisionException()
    {
        $spaceship = new Spaceship(
            'e6ce50ae-24c5-48ac-89bb-b64bfb8fd2ec',
            0,
            0
        );

        $canvas = new Canvas(
            'e6ce50ae-24c5-48ac-89bb-b64bfb8fd2ee',
            'canvas_name',
            1,
            1,
            $spaceship
        );

        $this->identifierGenerator->expects($this->exactly(1))
            ->method('uuid')
            ->willReturn('374ee4de-892c-4980-9b94-9e680b3d8a26');

        $canvas->addRandomBlocks(1, $this->identifierGenerator);
        $spaceship->moveRightIntoCanvas($canvas);
        $spaceship->moveBottomIntoCanvas($canvas);

        self::expectException(SpaceshipCollisionException::class);
        $canvas->checkSpaceshipCollision($spaceship);
    }

    public function testNotThrowCollisionException()
    {
        $spaceship = new Spaceship(
            'e6ce50ae-24c5-48ac-89bb-b64bfb8fd2ec',
            0,
            0
        );

        $canvas = new Canvas(
            'e6ce50ae-24c5-48ac-89bb-b64bfb8fd2ee',
            'canvas_name',
            1,
            1,
            $spaceship
        );

        $this->identifierGenerator->expects($this->exactly(1))
            ->method('uuid')
            ->willReturn('374ee4de-892c-4980-9b94-9e680b3d8a26');

        $canvas->addRandomBlocks(1, $this->identifierGenerator);
        $spaceship->moveBottomIntoCanvas($canvas);
        $canvas->checkSpaceshipCollision($spaceship);
        self::assertEquals(1,1);

    }

}