<?php

namespace App\Framework\Model\Exception;

class Error
{

    /* @var string $message */
    protected $message;

    /* @var int|null $code */
    protected $code;

    /**
     * @param string $message
     * @param int $code
     */
    public function __construct(string $message, ?int $code = null)
    {
        $this->message = $message;
        $this->code = $code;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @param string $message
     * @return Error
     */
    public function setMessage(string $message): Error
    {
        $this->message = $message;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getCode(): ?int
    {
        return $this->code;
    }

    /**
     * @param int|null $code
     * @return Error
     */
    public function setCode(?int $code)
    {
        $this->code = $code;

        return $this;
    }
}
