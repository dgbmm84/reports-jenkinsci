<?php

namespace App\Data\Mapper;


use App\Data\Model\Entity\ReportEntity;
use App\Domain\Model\Report;
use App\Domain\UseCase\Report\Add\Model\UCCreateModel;
use App\Domain\UseCase\Report\ListContent\Model\UCListModel;
use App\Domain\UseCase\Report\Update\Model\UCUpdateModel;

class ReportMapper
{

    /**
     * @param ReportEntity $reportEntity
     * @param $outputModelClass
     * @return UCCreateModel | UCUpdateModel | Report
     */
    public function map(ReportEntity $reportEntity, $outputModelClass)
    {
        $outputModel = new $outputModelClass();

        foreach ($reportEntity->getProperties() as $property) {
            $get = 'get'.ucfirst($property);
            $set = 'set'.ucfirst($property);
            if (method_exists($outputModel, $set) && method_exists($reportEntity, $get)) {
                $outputModel->$set($reportEntity->$get());
            }
        }

        return $outputModel;
    }
}