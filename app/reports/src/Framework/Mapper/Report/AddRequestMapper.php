<?php

namespace App\Framework\Mapper\Report;

use App\Domain\UseCase\Report\Add\AddRequest as RequestDomain;
use App\Framework\Model\Report\AddReportRequest as RequestFramework;
use App\Framework\Traits\CommonFunctionMapperTrait;

class AddRequestMapper
{

    use CommonFunctionMapperTrait;

    /**
     * @param $request
     * @param $requestDomainClass
     * @return RequestDomain
     * @throws \UnexpectedValueException
     */
    public function map(RequestFramework $request, $requestDomainClass): RequestDomain
    {

        /** @var RequestDomain $requestModel */
        $requestModel = new $requestDomainClass();
        if (!($request instanceof RequestFramework)) {
            throw new \UnexpectedValueException('Wrong data type received.');
        }

        return $this->mapPropertiesModel($request, $requestModel);
    }

}