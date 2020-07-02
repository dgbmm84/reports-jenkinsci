<?php

namespace App\Domain\Services;


use App\Domain\Model\Mail;

interface Mailer
{

    /**
     * @param Mail $mail
     */
    public function sendMail(Mail $mail): void;
}