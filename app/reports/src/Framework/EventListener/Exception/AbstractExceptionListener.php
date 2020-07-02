<?php

namespace App\Framework\EventListener\Exception;

use App\Framework\Model\Exception\Error;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Constraints\Collection;

abstract class AbstractExceptionListener
{

    /** @var LoggerInterface */
    protected $logger;

    /** @var SerializerInterface */
    protected $serializer;

    public function __construct(SerializerInterface $serializer, LoggerInterface $logger)
    {
        $this->serializer = $serializer;
        $this->logger = $logger;
    }

    /**
     * @param $exception
     * @param mixed $message
     */
    protected function logException(string $message, \Exception $exception): void
    {
        $this->logger->error($message, [
            'class' => \get_class($exception),
            'file' => $exception->getFile(),
            'line' => $exception->getLine(),
            'message' => $exception->getMessage(),
            'code' => $exception->getCode(),
        ]);
    }

    /**
     * @param GetResponseForExceptionEvent $event
     * @param mixed $httpResponseCode
     * @param array|null $errorCollection
     * @throws \Symfony\Component\Validator\Exception\MissingOptionsException
     * @throws \Symfony\Component\Validator\Exception\InvalidOptionsException
     * @throws \Symfony\Component\Validator\Exception\ConstraintDefinitionException
     * @throws \InvalidArgumentException
     */
    protected function processKernelException(
        GetResponseForExceptionEvent $event,
        int $httpResponseCode = JsonResponse::HTTP_INTERNAL_SERVER_ERROR,
        ?array $errorCollection = []
    ): void {

        if (null === $errorCollection) {
            $errorCollection = [
                new Error('Unexpected error. Stay tuned - our team is working on it'),
            ];
        }

        $event->setResponse(JsonResponse::fromJsonString(
            $this->serializer->serialize($errorCollection, 'json'),
            $httpResponseCode
        ));
    }
}
