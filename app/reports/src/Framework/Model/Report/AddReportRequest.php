<?php

namespace App\Framework\Model\Report;

use Symfony\Component\Validator\Constraints as Assert;

class AddReportRequest
{

    /**
     * @Assert\NotBlank()
     * @Assert\NotNull()
     * @Assert\Type("string")
     * @var $title
     */
    public $title;

    /**
     * @Assert\NotBlank()
     * @Assert\NotNull()
     * @Assert\Type("string")
     * @var $content
     */
    public $content;

    /**
     * @Assert\NotBlank()
     * @Assert\NotNull()
     * @Assert\Email
     * @var $mail
     */
    public $mail;

    /**
     * @Assert\NotBlank()
     * @Assert\NotNull()
     * @Assert\Type("array")
     * @var $metadata
     */
    public $metadata;

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     * @return AddReportRequest
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     * @return AddReportRequest
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * @param mixed $mail
     * @return AddReportRequest
     */
    public function setMail($mail)
    {
        $this->mail = $mail;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getMetadata()
    {
        return $this->metadata;
    }

    /**
     * @param mixed $metadata
     * @return AddReportRequest
     */
    public function setMetadata($metadata)
    {
        $this->metadata = $metadata;

        return $this;
    }

    public function getProperties()
    {
        return array_keys(get_object_vars($this));
    }
}