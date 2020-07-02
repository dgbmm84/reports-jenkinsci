<?php

namespace App\Domain\Model;


class Mail
{

    /** @var string */
    protected $receiver;

    /** @var string */
    protected $subject;

    /** @var string */
    protected $template;

    /** @var array */
    protected $parameters;

    /**
     * @return string
     */
    public function getReceiver(): string
    {
        return $this->receiver;
    }

    /**
     * @param string $receiver
     * @return Mail
     */
    public function setReceiver(string $receiver): Mail
    {
        $this->receiver = $receiver;

        return $this;
    }

    /**
     * @return string
     */
    public function getSubject(): string
    {
        return $this->subject;
    }

    /**
     * @param string $subject
     * @return Mail
     */
    public function setSubject(string $subject): Mail
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * @return string
     */
    public function getTemplate(): string
    {
        return $this->template;
    }

    /**
     * @param string $template
     * @return Mail
     */
    public function setTemplate(string $template): Mail
    {
        $this->template = $template;

        return $this;
    }

    /**
     * @return array
     */
    public function getParameters(): array
    {
        return $this->parameters;
    }

    /**
     * @param array $parameters
     * @return Mail
     */
    public function setParameters(array $parameters): Mail
    {
        $this->parameters = $parameters;

        return $this;
    }
}