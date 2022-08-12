<?php

namespace PHPUnit\Tests\Unit\Application\Spaceship\CommandHandler;

use PHPUnit\Framework\MockObject\MockBuilder;
use PHPUnit\Framework\TestCase;
use Witrac\Application\Spaceship\Command\SpaceshipMoveRight;
use Witrac\Application\Spaceship\CommandHandler\SpaceshipMoveRightHandler;
use Witrac\Domain\Canvas\Model\Entity\Canvas;
use Witrac\Domain\Canvas\Repository\CanvasRepository;
use Witrac\Domain\Spaceship\Model\Entity\Spaceship;
use Witrac\Domain\Spaceship\Repository\SpaceShipRepository;

class SpaceshipMoveRightHandlerTest extends TestCase
{
    private MockBuilder|CanvasRepository $canvasRepository;
    private MockBuilder|SpaceShipRepository $spaceShipRepository;
    private MockBuilder|Canvas $canvas;
    private MockBuilder|Spaceship $spaceship;
    private SpaceshipMoveRightHandler $spaceshipMoveRightHandler;

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
            ->onlyMethods(['spaceship'])
            ->getMock();
        $this->spaceship = $this->getMockBuilder(Spaceship::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['moveRightIntoCanvas'])
            ->getMock();
        $this->spaceshipMoveRightHandler = new SpaceshipMoveRightHandler(
            $this->canvasRepository,
            $this->spaceShipRepository
        );

    }

    public function testSpaceshipMoveRightHandlerInvoke()
    {

        $command = new SpaceshipMoveRight('canvas_name');

        $this->canvasRepository->expects($this->exactly(1))
            ->method('findByNameOrFail')
            ->with($command->canvasName())
            ->willReturn($this->canvas);

        $this->canvas->expects($this->exactly(1))
            ->method('spaceship')
            ->willReturn($this->spaceship);

        $this->spaceship->expects($this->exactly(1))
            ->method('moveRightIntoCanvas')
            ->with($this->canvas);

        $this->spaceShipRepository->expects($this->exactly(1))
            ->method('save')
            ->with($this->spaceship);

        $this->spaceshipMoveRightHandler->__invoke($command);
    }

}