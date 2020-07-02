<?php

namespace App\Domain\UseCase\Report\ListContent;

class ListContentResponse
{
    /** @var array $models */
    protected $models;

    /**
     * @return array
     */
    public function getModels(): array
    {
        return $this->models;
    }

    /**
     * @param array $models
     * @return ListContentResponse
     */
    public function setModels(array $models): ListContentResponse
    {
        $this->models = $models;

        return $this;
    }
}
