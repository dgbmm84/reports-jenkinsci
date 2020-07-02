<?php

namespace App\Domain\UseCase\Report\Add;

use App\Domain\UseCase\Report\Add\Model\UCCreateModel;

class AddResponse
{
    /** @var UCCreateModel $model */
    protected $model;

    /**
     * @return UCCreateModel
     */
    public function getModel(): UCCreateModel
    {
        return $this->model;
    }

    /**
     * @param UCCreateModel $model
     * @return AddResponse
     */
    public function setModel(UCCreateModel $model): AddResponse
    {
        $this->model = $model;
        return $this;
    }
}
