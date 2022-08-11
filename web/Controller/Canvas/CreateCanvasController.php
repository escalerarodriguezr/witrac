<?php
declare(strict_types=1);

namespace App\Controller\Canvas;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class CreateCanvasController
{


    public function __construct()
    {
    }

    public function __invoke():Response
    {
        return new JsonResponse(null,Response::HTTP_OK);
        // TODO: Implement __invoke() method.
    }


}