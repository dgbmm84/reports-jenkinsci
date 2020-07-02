<?php

namespace App\Framework\EventListener\Exception;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class NotFoundHttpExceptionListener extends AbstractExceptionListener
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

        if (!($exception instanceof NotFoundHttpException)) {
            return;
        }
        $event->setResponse(new Response('', Response::HTTP_NOT_FOUND));
    }
}
