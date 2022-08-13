<?php

namespace PHPUnit\Tests\Acceptance\Spaceship;

use App\Controller\Spaceship\SpaceshipMoveTopController;
use PHPUnit\Tests\Acceptance\AcceptanceTestBase;
use PHPUnit\Tests\Acceptance\Canvas\CreateCanvasActionTest;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Witrac\Application\Canvas\QueryHandler\GetCanvasByNameQueryHandler\GetCanvasByNameQueryView;
use Witrac\Infrastructure\Ui\Http\Listener\Shared\JsonTransformerExceptionListener;
use Witrac\Infrastructure\Ui\Http\Request\DTO\CreateCanvasRequest;

class SpaceshipMoveTopActionTest extends AcceptanceTestBase
{
    private const ENDPOINT = '/move/%s/top';
    private const CREATE_CANVAS_ENDPOINT = '/create-canvas';
    private const MOVE_RIGHT_ENDPOINT = '/move/%s/right';

    public function setUp():void
    {
        parent::setUp();
    }

    public function testMoveBottomSuccessResponse()
    {
        $httpClient = $this->getBaseClient();

        $httpClient->request(Request::METHOD_GET,
            sprintf(self::ENDPOINT,CreateCanvasActionTest::CREATED_CANVAS_NAME)
        );

        $response = $httpClient->getResponse();
        self::assertEquals(Response::HTTP_OK,$response->getStatusCode());

        $responseData = \json_decode($response->getContent(),true);

        self::assertArrayHasKey(SpaceshipMoveTopController::KEY_RESPONSE_STATUS, $responseData);
        self::assertArrayHasKey(SpaceshipMoveTopController::KEY_RESPONSE_CANVAS, $responseData);
        self::assertEquals(SpaceshipMoveTopController::RESPONSE_STATUS_MOVED,$responseData['status']);

        $canvas = $responseData[SpaceshipMoveTopController::KEY_RESPONSE_CANVAS];
        self::assertEquals($canvas[GetCanvasByNameQueryView::KEY_NAME],CreateCanvasActionTest::CREATED_CANVAS_NAME);
        self::assertArrayHasKey(GetCanvasByNameQueryView::KEY_WIDTH,$canvas);
        self::assertArrayHasKey(GetCanvasByNameQueryView::KEY_HEIGHT,$canvas);
        self::assertArrayHasKey(GetCanvasByNameQueryView::KEY_SPACESHIP,$canvas);

    }

    public function testMoveBottomCanvasNotFoundResponse()
    {
        $httpClient = $this->getBaseClient();

        $httpClient->request(Request::METHOD_GET,
            sprintf(self::ENDPOINT,'fake_canvas')
        );

        $response = $httpClient->getResponse();
        self::assertEquals(Response::HTTP_NOT_FOUND,$response->getStatusCode());
    }

    public function testMoveTopCollisionResponse()
    {
        $httpClient = $this->getBaseClient();
        $queryParams = [
            CreateCanvasRequest::NAME_PARAM => "canvas_name",
            CreateCanvasRequest::WIDTH_PARAM => 1,
            CreateCanvasRequest::HEIGHT_PARAM => 1,
            CreateCanvasRequest::BLOCKS_PARAMS => 1
        ];

        $httpClient->request(Request::METHOD_GET, self::CREATE_CANVAS_ENDPOINT, $queryParams);
        $httpClient->getResponse();

        $httpClient->request(Request::METHOD_GET,
            sprintf(self::MOVE_RIGHT_ENDPOINT,CreateCanvasActionTest::CREATED_CANVAS_NAME)
        );
        $httpClient->getResponse();


        $httpClient->request(Request::METHOD_GET,
            sprintf(self::ENDPOINT,CreateCanvasActionTest::CREATED_CANVAS_NAME)
        );

        $response = $httpClient->getResponse();
        self::assertEquals(Response::HTTP_CONFLICT,$response->getStatusCode());

        $responseData = \json_decode($response->getContent(),true);
        self::assertArrayHasKey(JsonTransformerExceptionListener::ERRORS_KEY, $responseData);

        $queryParams = [
            CreateCanvasRequest::NAME_PARAM => "canvas_name",
            CreateCanvasRequest::WIDTH_PARAM => 50,
            CreateCanvasRequest::HEIGHT_PARAM => 50
        ];

        $httpClient->request(Request::METHOD_GET, self::CREATE_CANVAS_ENDPOINT, $queryParams);
        $httpClient->getResponse();

    }

}