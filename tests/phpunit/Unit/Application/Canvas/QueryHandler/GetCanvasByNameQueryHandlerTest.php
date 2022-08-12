<?php

namespace PHPUnit\Tests\Unit\Application\Canvas\QueryHandler;

use PHPUnit\Framework\MockObject\MockBuilder;
use PHPUnit\Framework\TestCase;
use Witrac\Application\Canvas\Query\GetCanvasByName;
use Witrac\Application\Canvas\QueryHandler\GetCanvasByNameQueryHandler\GetCanvasByNameQueryHandler;
use Witrac\Application\Canvas\QueryHandler\GetCanvasByNameQueryHandler\GetCanvasByNameQueryView;
use Witrac\Domain\Canvas\Model\Entity\Canvas;
use Witrac\Domain\Canvas\Repository\CanvasRepository;
use Witrac\Domain\Spaceship\Model\Entity\Spaceship;

class GetCanvasByNameQueryHandlerTest extends TestCase
{
    private MockBuilder|CanvasRepository $canvasRepository;
    private GetCanvasByNameQueryHandler $getCanvasByNameQueryHandler;

    protected function setUp(): void
    {
        parent::setUp();

        $this->canvasRepository = $this->getMockBuilder(CanvasRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->getCanvasByNameQueryHandler = new GetCanvasByNameQueryHandler($this->canvasRepository);
    }

    public function testGetCanvasByNameQueryHandlerInvokeReturnNull()
    {
        $getCanvasByNameQuery = new GetCanvasByName('canvas_name');

        $this->canvasRepository->expects($this->exactly(1))
            ->method('findByName')
            ->with($getCanvasByNameQuery->name())
            ->willReturn(null);
        $response = $this->getCanvasByNameQueryHandler->__invoke($getCanvasByNameQuery);

        self::assertNull($response);
    }

    public function testGetCanvasByNameQueryHandlerInvokeReturnQueryView()
    {
        $getCanvasByNameQuery = new GetCanvasByName('canvas_name');

        $spaceship = new Spaceship(
            '6b27a228-8b0c-419e-b3db-f8377f6b8d6b',
            0,
            0
        );

        $canvas = new Canvas(
            '679fb5f7-3205-48ff-8df4-70867df64eec',
            'canvas_name',
            50,
            50,
            $spaceship
        );

        $this->canvasRepository->expects($this->exactly(1))
            ->method('findByName')
            ->with($getCanvasByNameQuery->name())
            ->willReturn($canvas);

        $response = $this->getCanvasByNameQueryHandler->__invoke($getCanvasByNameQuery);

        self::assertInstanceOf(GetCanvasByNameQueryView::class, $response);
    }


}