<?php

namespace PHPUnit\Tests\Acceptance\Spaceship;

use App\Controller\Spaceship\SpaceshipMoveRightController;
use PHPUnit\Tests\Acceptance\AcceptanceTestBase;
use PHPUnit\Tests\Acceptance\Canvas\CreateCanvasActionTest;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Witrac\Application\Canvas\QueryHandler\GetCanvasByNameQueryHandler\GetCanvasByNameQueryView;

class SpaceshipMoveRightActionTest extends AcceptanceTestBase
{
    private const ENDPOINT = '/move/%s/right';

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

        self::assertArrayHasKey(SpaceshipMoveRightController::KEY_RESPONSE_STATUS, $responseData);
        self::assertArrayHasKey(SpaceshipMoveRightController::KEY_RESPONSE_CANVAS, $responseData);
        self::assertEquals(SpaceshipMoveRightController::RESPONSE_STATUS_MOVED,$responseData['status']);

        $canvas = $responseData[SpaceshipMoveRightController::KEY_RESPONSE_CANVAS];
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


}