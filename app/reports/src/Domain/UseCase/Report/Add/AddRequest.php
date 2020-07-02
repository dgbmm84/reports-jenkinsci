<?php

namespace App\Domain\UseCase\Report\Add;

class AddRequest
{
    /** @var string */
    public $title;

    /** @var string */
    public $content;

    /** @var string */
    public $mail;

    /** @var array */
    public $metadata;

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return AddRequest
     */
    public function setTitle(string $title): AddRequest
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @param string $content
     * @return AddRequest
     */
    public function setContent(string $content): AddRequest
    {
        $this->content = $content;

        return $this;
    }

    /**
     * @return string
     */
    public function getMail(): string
    {
        return $this->mail;
    }

    /**
     * @param string $mail
     * @return AddRequest
     */
    public function setMail(string $mail): AddRequest
    {
        $this->mail = $mail;

        return $this;
    }

    /**
     * @return array
     */
    public function getMetadata(): array
    {
        return $this->metadata;
    }

    /**
     * @param array $metadata
     * @return AddRequest
     */
    public function setMetadata(array $metadata): AddRequest
    {
        $this->metadata = $metadata;

        return $this;
    }

}
