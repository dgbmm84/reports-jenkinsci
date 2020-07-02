<?php

namespace App\Data\Model\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Data\Database\ReportDatabase")
 * @ORM\Table(name="report")
 */
class ReportEntity
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", nullable=false)
     */
    private $title;

    /**
     * @ORM\Column(type="text", nullable=false)
     */
    private $content;

    /**
     * @ORM\Column(type="string", nullable=false)
     */
    private $mail;

    /**
     * @ORM\Column(type="array", nullable=false)
     */
    private $metadata;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $priority;

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     * @return ReportEntity
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
     * @return ReportEntity
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
     * @return ReportEntity
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
     * @return ReportEntity
     */
    public function setMetadata($metadata)
    {
        $this->metadata = $metadata;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * @param mixed $priority
     * @return ReportEntity
     */
    public function setPriority($priority)
    {
        $this->priority = $priority;
        return $this;
    }



    public function getProperties()
    {
        return array_keys(get_object_vars($this));
    }
}
