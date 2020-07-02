<?php

namespace App\Framework\EventListener\Exception;

use App\Domain\Exception\ValidationException;
use App\Framework\Mapper\ErrorMapper;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;

class ValidationExceptionListener extends AbstractExceptionListener
{

    /**
     * @param GetResponseForExceptionEvent $event
     * @throws \Symfony\Component\Validator\Exception\MissingOptionsException
     * @throws \Symfony\Component\Validator\Exception\InvalidOptionsException
     * @throws \Symfony\Component\Validator\Exception\ConstraintDefinitionException
     * @throws \InvalidArgumentException
     */
    public function onKernelException(GetResponseForExceptionEvent $event)
    {

        $exception = $event->getException();

        if (!($exception instanceof ValidationException)) {
            return;
        }

        $this->processKernelException(
            $event,
            Response::HTTP_BAD_REQUEST,
            (new ErrorMapper())->map($exception->getErrors())
        );
    }
}
