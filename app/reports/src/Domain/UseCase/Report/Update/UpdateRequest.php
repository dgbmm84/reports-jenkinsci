<?php

namespace App\Domain\UseCase\Report\Update;


class UpdateRequest
{

    /** @var integer */
    public $id;

    /** @var string */
    public $title;

    /** @var string */
    public $content;

    /** @var string */
    public $mail;

    /** @var array */
    public $metadata;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return UpdateRequest
     */
    public function setId(int $id): UpdateRequest
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return UpdateRequest
     */
    public function setTitle(?string $title): UpdateRequest
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return string
     */
    public function getContent(): ?string
    {
        return $this->content;
    }

    /**
     * @param string $content
     * @return UpdateRequest
     */
    public function setContent(?string $content): UpdateRequest
    {
        $this->content = $content;

        return $this;
    }

    /**
     * @return string
     */
    public function getMail(): ?string
    {
        return $this->mail;
    }

    /**
     * @param string $mail
     * @return UpdateRequest
     */
    public function setMail(?string $mail): UpdateRequest
    {
        $this->mail = $mail;

        return $this;
    }

    /**
     * @return array
     */
    public function getMetadata(): ?array
    {
        return $this->metadata;
    }

    /**
     * @param array $metadata
     * @return UpdateRequest
     */
    public function setMetadata(?array $metadata): UpdateRequest
    {
        $this->metadata = $metadata;

        return $this;
    }
}
