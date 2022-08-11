<?php
declare(strict_types=1);

namespace Witrac\Infrastructure\Ui\Http\Listener\Shared;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

class JsonTransformerExceptionListener
{
    public function onKernelException(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();


        $data = [
            'class' => \get_class($exception),
            'code' => Response::HTTP_INTERNAL_SERVER_ERROR,
            'message' => $exception->getMessage(),
        ];


        if ($exception instanceof HttpExceptionInterface) {
            $data['code'] = $exception->getStatusCode();
        }

        $event->setResponse($this->prepareResponse($data));

    }

    private function prepareResponse(array $data): JsonResponse
    {
        $response = new JsonResponse($data, $data['code']);
        $response->headers->set('X-Error-Code', $data['code']);
        $response->headers->set('X-Server-Time', \time());

        return $response;
    }

}