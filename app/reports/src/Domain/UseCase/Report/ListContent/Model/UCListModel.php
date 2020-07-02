<?php

namespace App\Domain\UseCase\Report\ListContent\Model;

use App\Domain\Model\Report;

class UCListModel
{

    /** @var Report $model */
    public $model;

    /**
     * @return Report
     */
    public function getModel(): Report
    {
        return $this->model;
    }

    /**
     * @param Report $model
     * @return UCListModel
     */
    public function setModel(Report $model): UCListModel
    {
        $this->model = $model;

        return $this;
    }
}