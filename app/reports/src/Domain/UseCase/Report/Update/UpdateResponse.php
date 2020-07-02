<?php

namespace App\Domain\UseCase\Report\Update;

use App\Domain\Model\Report;
use App\Domain\UseCase\Report\Update\Model\UCUpdateModel;

class UpdateResponse
{
    /** @var UCUpdateModel $model */
    protected $model;

    /** @var Report $entireModel */
    protected $entireModel;

    /**
     * @return UCUpdateModel
     */
    public function getModel(): UCUpdateModel
    {
        return $this->model;
    }

    /**
     * @param UCUpdateModel $model
     * @return UpdateResponse
     */
    public function setModel(UCUpdateModel $model): UpdateResponse
    {
        $this->model = $model;

        return $this;
    }

    /**
     * @return Report
     */
    public function getEntireModel(): Report
    {
        return $this->entireModel;
    }

    /**
     * @param Report $entireModel
     * @return UpdateResponse
     */
    public function setEntireModel(Report $entireModel): UpdateResponse
    {
        $this->entireModel = $entireModel;

        return $this;
    }
}
