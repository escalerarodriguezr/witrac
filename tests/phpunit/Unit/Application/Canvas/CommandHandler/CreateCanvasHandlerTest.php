<?php

namespace PHPUnit\Tests\Unit\Application\Canvas\CommandHandler;

use PHPUnit\Framework\MockObject\MockBuilder;
use PHPUnit\Framework\TestCase;
use Witrac\Application\Canvas\Command\CreateCanvas;
use Witrac\Application\Canvas\CommandHandler\CreateCanvasHandler;
use Witrac\Domain\Canvas\Model\Entity\Canvas;
use Witrac\Domain\Canvas\Repository\CanvasRepository;
use Witrac\Domain\Shared\Service\IdentifierGenerator\IdentifierGenerator;
use Witrac\Domain\Spaceship\Model\Entity\Spaceship;
use Witrac\Domain\Spaceship\Repository\SpaceShipRepository;

class CreateCanvasHandlerTest extends TestCase
{
    private MockBuilder|IdentifierGenerator $identifierGenerator;
    private MockBuilder|SpaceShipRepository $spaceShipRepository;
    private MockBuilder|CanvasRepository $canvasRepository;
    private CreateCanvasHandler $createCanvasHandler;

    protected function setUp(): void
    {
        parent::setUp();

        $this->identifierGenerator = $this->getMockBuilder(IdentifierGenerator::class)
            ->disableOriginalConstructor()
            ->getMock();
        $this->spaceShipRepository = $this->getMockBuilder(SpaceShipRepository::class)
            ->disableOriginalConstructor()
            ->getMock();
        $this->canvasRepository = $this->getMockBuilder(CanvasRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->createCanvasHandler = new CreateCanvasHandler(
            $this->identifierGenerator,
            $this->spaceShipRepository,
            $this->canvasRepository
        );
    }

    public function testCreateCanvasHandlerInvoke()
    {
        $createCanvas = new CreateCanvas(
            "canvas_name",
            20,
            20
        );

        $this->canvasRepository->expects($this->exactly(1))
            ->method('deleteByName')
            ->with($createCanvas->name());

        $this->identifierGenerator->expects($this->exactly(2))
            ->method('uuid');

        $this->spaceShipRepository->expects($this->exactly(1))
            ->method('save')
            ->with($this->isInstanceOf(Spaceship::class));

        $this->canvasRepository->expects($this->exactly(1))
            ->method('save')
            ->with($this->isInstanceOf(Canvas::class));

        $this->createCanvasHandler->__invoke($createCanvas);
    }

}