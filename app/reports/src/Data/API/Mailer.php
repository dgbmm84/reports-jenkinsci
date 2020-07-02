<?php

namespace App\Data\API;


use App\Domain\Exception\MailerErrorException;
use App\Domain\Model\Mail;

class Mailer implements \App\Domain\Services\Mailer
{

    /** @var \Swift_Mailer $mailer */
    private $mailer;

    /** @var \Twig_Environment $twigEnvironment */
    private $twigEnvironment;

    /**
     * Mailer constructor.
     * @param \Swift_Mailer $mailer
     * @param \Twig_Environment $twigEnvironment
     */
    public function __construct(
        \Swift_Mailer $mailer,
        \Twig_Environment $twigEnvironment
    ) {
        $this->mailer = $mailer;
        $this->twigEnvironment = $twigEnvironment;
    }

    /**
     * @param Mail $mail
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Loader
     * @throws MailerErrorException
     * @throws \Twig_Error_Syntax
     */
    public function sendMail(Mail $mail): void
    {

        $message = (new \Swift_Message($mail->getSubject()))
            ->setFrom('test@test.com', 'BuscoExtra')
            ->setTo($mail->getReceiver())
            ->setBody(
                $this->twigEnvironment->render(
                    $mail->getTemplate(),
                    $mail->getParameters()
                ),
                'text/html'
            );

        if (!$this->mailer->send($message)) {
            throw new MailerErrorException(sprintf('%s', 'There were issues sending notifications'));
        }
    }

}