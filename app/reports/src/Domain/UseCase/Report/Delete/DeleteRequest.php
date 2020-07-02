<?php

namespace App\Domain\UseCase\Report\Delete;

class DeleteRequest
{
    /** @var string $id */
    public $id;

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     * @return DeleteRequest
     */
    public function setId(string $id): DeleteRequest
    {
        $this->id = $id;

        return $this;
    }
}
