<?php

namespace PHPUnit\Tests\Unit\Application\Spaceship\CommandHandler;

use PHPUnit\Framework\MockObject\MockBuilder;
use PHPUnit\Framework\TestCase;
use Witrac\Application\Spaceship\Command\SpaceshipMoveBottom;
use Witrac\Application\Spaceship\CommandHandler\SpaceshipMoveBottomHandler;
use Witrac\Domain\Canvas\Model\Entity\Canvas;
use Witrac\Domain\Canvas\Repository\CanvasRepository;
use Witrac\Domain\Spaceship\Model\Entity\Spaceship;
use Witrac\Domain\Spaceship\Repository\SpaceShipRepository;

class SpaceshipMoveBottomHandlerTest extends TestCase
{
    private MockBuilder|CanvasRepository $canvasRepository;
    private MockBuilder|SpaceShipRepository $spaceShipRepository;
    private MockBuilder|Canvas $canvas;
    private MockBuilder|Spaceship $spaceship;
    private SpaceshipMoveBottomHandler $spaceshipMoveRightHandler;

    protected function setUp(): void
    {
        parent::setUp();

        $this->canvasRepository = $this->getMockBuilder(CanvasRepository::class)
            ->disableOriginalConstructor()
            ->getMock();
        $this->spaceShipRepository = $this->getMockBuilder(SpaceShipRepository::class)
            ->disableOriginalConstructor()
            ->getMock();
        $this->canvas = $this->getMockBuilder(Canvas::class)
            ->disableOriginalConstructor()
            ->getMock();
        $this->spaceship = $this->getMockBuilder(Spaceship::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['moveBottomIntoCanvas'])
            ->getMock();
        $this->spaceshipMoveRightHandler = new SpaceshipMoveBottomHandler(
            $this->canvasRepository,
            $this->spaceShipRepository
        );

    }

    public function testSpaceshipMoveBottomHandlerInvoke()
    {

        $command = new SpaceshipMoveBottom('canvas_name');

        $this->canvasRepository->expects($this->exactly(1))
            ->method('findByNameOrFail')
            ->with($command->canvasName())
            ->willReturn($this->canvas);

        $this->canvas->expects($this->exactly(1))
            ->method('spaceship')
            ->willReturn($this->spaceship);

        $this->canvas->expects($this->exactly(1))
            ->method('checkSpaceshipCollision')
            ->with($this->spaceship);

        $this->spaceship->expects($this->exactly(1))
            ->method('moveBottomIntoCanvas')
            ->with($this->canvas);

        $this->spaceShipRepository->expects($this->exactly(1))
            ->method('save')
            ->with($this->spaceship);

        $this->spaceshipMoveRightHandler->__invoke($command);
    }

}