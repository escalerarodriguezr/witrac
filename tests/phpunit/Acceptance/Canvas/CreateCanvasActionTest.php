<?php

namespace PHPUnit\Tests\Acceptance\Canvas;

use App\Controller\Canvas\CreateCanvasController;
use PHPUnit\Tests\Acceptance\AcceptanceTestBase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Witrac\Application\Canvas\QueryHandler\GetCanvasByNameQueryHandler\GetCanvasByNameQueryView;
use Witrac\Application\Canvas\QueryHandler\GetCanvasByNameQueryHandler\SpaceshipView;
use Witrac\Infrastructure\Ui\Http\Request\DTO\CreateCanvasRequest;

class CreateCanvasActionTest extends AcceptanceTestBase
{
    private const ENDPOINT = '/create-canvas';
    const CREATED_CANVAS_NAME = 'canvas_name';

    public function setUp():void
    {
        parent::setUp();
    }

    public function testCreateCanvasSuccessResponse()
    {
        $httpClient = $this->getBaseClient();

        $queryParams = [
            CreateCanvasRequest::NAME_PARAM => "canvas_name",
            CreateCanvasRequest::WIDTH_PARAM => 50,
            CreateCanvasRequest::HEIGHT_PARAM => 50
        ];

        $httpClient->request(Request::METHOD_GET, self::ENDPOINT, $queryParams);

        $response = $httpClient->getResponse();
        self::assertEquals(Response::HTTP_CREATED,$response->getStatusCode());

        $responseData = \json_decode($response->getContent(),true);

        self::assertArrayHasKey(CreateCanvasController::KEY_RESPONSE_STATUS, $responseData);
        self::assertArrayHasKey(CreateCanvasController::KEY_RESPONSE_CANVAS, $responseData);
        self::assertEquals(CreateCanvasController::RESPONSE_STATUS_CREATED,$responseData['status']);

        $canvas = $responseData[CreateCanvasController::KEY_RESPONSE_CANVAS];
        self::assertEquals($canvas[GetCanvasByNameQueryView::KEY_NAME],'canvas_name');
        self::assertEquals($canvas[GetCanvasByNameQueryView::KEY_WIDTH],50);
        self::assertEquals($canvas[GetCanvasByNameQueryView::KEY_HEIGHT],50);

        $spaceship = $canvas[GetCanvasByNameQueryView::KEY_SPACESHIP];
        self::assertEquals($spaceship[SpaceshipView::KEY_X],0);
        self::assertEquals($spaceship[SpaceshipView::KEY_Y],0);

        self::assertArrayHasKey(GetCanvasByNameQueryView::KEY_BLOCKS,$canvas);
        $blocks = $canvas[GetCanvasByNameQueryView::KEY_BLOCKS];
        self::assertCount(0,$blocks);

    }

    public function testCreateCanvasInvalidName()
    {
        $httpClient = $this->getBaseClient();
        $queryParams = [
            CreateCanvasRequest::NAME_PARAM => "",
            CreateCanvasRequest::WIDTH_PARAM => 50,
            CreateCanvasRequest::HEIGHT_PARAM => 50
        ];
        $httpClient->request(Request::METHOD_GET, self::ENDPOINT, $queryParams);
        $response = $httpClient->getResponse();
        self::assertEquals(Response::HTTP_BAD_REQUEST,$response->getStatusCode());
    }

    public function testCreateCanvasMissingName()
    {
        $httpClient = $this->getBaseClient();
        $queryParams = [
            CreateCanvasRequest::WIDTH_PARAM => 50,
            CreateCanvasRequest::HEIGHT_PARAM => 50
        ];
        $httpClient->request(Request::METHOD_GET, self::ENDPOINT, $queryParams);
        $response = $httpClient->getResponse();
        self::assertEquals(Response::HTTP_BAD_REQUEST,$response->getStatusCode());
    }

    public function testCreateCanvasInvalidWidth()
    {
        $httpClient = $this->getBaseClient();
        $queryParams = [
            CreateCanvasRequest::NAME_PARAM => "canvas_name",
            CreateCanvasRequest::WIDTH_PARAM => "fake",
            CreateCanvasRequest::HEIGHT_PARAM => 50
        ];
        $httpClient->request(Request::METHOD_GET, self::ENDPOINT, $queryParams);
        $response = $httpClient->getResponse();
        self::assertEquals(Response::HTTP_BAD_REQUEST,$response->getStatusCode());
    }

    public function testCreateCanvasMissingWidth()
    {
        $httpClient = $this->getBaseClient();
        $queryParams = [
            CreateCanvasRequest::NAME_PARAM => "canvas_name",
            CreateCanvasRequest::HEIGHT_PARAM => 50
        ];
        $httpClient->request(Request::METHOD_GET, self::ENDPOINT, $queryParams);
        $response = $httpClient->getResponse();
        self::assertEquals(Response::HTTP_BAD_REQUEST,$response->getStatusCode());
    }

    public function testCreateCanvasInvalidHeight()
    {
        $httpClient = $this->getBaseClient();
        $queryParams = [
            CreateCanvasRequest::NAME_PARAM => "canvas_name",
            CreateCanvasRequest::WIDTH_PARAM => 50,
            CreateCanvasRequest::HEIGHT_PARAM => "fake"
        ];
        $httpClient->request(Request::METHOD_GET, self::ENDPOINT, $queryParams);
        $response = $httpClient->getResponse();
        self::assertEquals(Response::HTTP_BAD_REQUEST,$response->getStatusCode());
    }

    public function testCreateCanvasMissingHeight()
    {
        $httpClient = $this->getBaseClient();
        $queryParams = [
            CreateCanvasRequest::NAME_PARAM => "canvas_name",
            CreateCanvasRequest::WIDTH_PARAM => 50,
        ];
        $httpClient->request(Request::METHOD_GET, self::ENDPOINT, $queryParams);
        $response = $httpClient->getResponse();
        self::assertEquals(Response::HTTP_BAD_REQUEST,$response->getStatusCode());
    }

    public function testCreateCanvasAddTwoBlocks()
    {
        $httpClient = $this->getBaseClient();
        $queryParams = [
            CreateCanvasRequest::NAME_PARAM => "canvas_name",
            CreateCanvasRequest::WIDTH_PARAM => 50,
            CreateCanvasRequest::HEIGHT_PARAM => 50,
            CreateCanvasRequest::BLOCKS_PARAMS => 2
        ];

        $httpClient->request(Request::METHOD_GET, self::ENDPOINT, $queryParams);
        $response = $httpClient->getResponse();

        self::assertEquals(Response::HTTP_CREATED,$response->getStatusCode());
        $responseData = \json_decode($response->getContent(),true);

        $canvas = $responseData[CreateCanvasController::KEY_RESPONSE_CANVAS];
        self::assertArrayHasKey(GetCanvasByNameQueryView::KEY_BLOCKS,$canvas);

        $blocks = $canvas[GetCanvasByNameQueryView::KEY_BLOCKS];
        self::assertCount(2,$blocks);
        self::assertArrayHasKey(GetCanvasByNameQueryView::BLOCK_X,$blocks[0]);
        self::assertArrayHasKey(GetCanvasByNameQueryView::BLOCK_Y,$blocks[0]);

    }

}