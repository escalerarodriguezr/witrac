<?php
declare(strict_types=1);

namespace Witrac\Infrastructure\Ui\Http\Listener\Shared;

use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Symfony\Component\Messenger\Exception\HandlerFailedException;
use Witrac\Domain\Canvas\Model\Exception\CanvasNotFoundException;

class JsonTransformerExceptionListener
{
    public function onKernelException(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();

        if ($exception instanceof HandlerFailedException) {
            $exception = $exception->getPrevious();
        }

        $class = \get_class($exception);
        $code = Response::HTTP_INTERNAL_SERVER_ERROR;
        $data = [
            'errors' => $exception->getMessage(),
        ];

        if ($exception instanceof HttpExceptionInterface) {
            $code = $exception->getStatusCode();
        }

        if (\in_array($class, $this->getNotFoundExceptions(), true)) {
            $code = Response::HTTP_NOT_FOUND;

            $data['errors'] = [$exception->getMessage()];

        }


        if ($exception instanceof BadRequestHttpException) {
            $code = $exception->getStatusCode();
            $data['errors'] = [];
            foreach ( json_decode($exception->getMessage()) as $error ){
                $data['errors'] = $error;
            }
        }

        $event->setResponse($this->prepareResponse($data,$code));

    }

    private function prepareResponse(array $data, int $code): JsonResponse
    {
        $response = new JsonResponse($data, $code);
        $response->headers->set('X-Error-Code', $code);
        $response->headers->set('X-Server-Time', \time());

        return $response;
    }

    private function getNotFoundExceptions(): array
    {
        return [
            CanvasNotFoundException::class
        ];
    }

}