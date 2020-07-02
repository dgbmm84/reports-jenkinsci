<?php

namespace App\Domain\Model;


class Report
{

    /** @var int */
    protected $id;

    /** @var string */
    protected $title;

    /** @var string */
    protected $content;

    /** @var string */
    protected $mail;

    /** @var array */
    protected $metadata;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Report
     */
    public function setId(int $id): Report
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return Report
     */
    public function setTitle(string $title): Report
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
     * @return Report
     */
    public function setContent(string $content): Report
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
     * @return Report
     */
    public function setMail(string $mail): Report
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
     * @return Report
     */
    public function setMetadata(array $metadata): Report
    {
        $this->metadata = $metadata;

        return $this;
    }
}
