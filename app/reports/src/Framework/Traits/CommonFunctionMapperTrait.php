<?php

namespace App\Framework\Traits;


trait CommonFunctionMapperTrait
{

    /**
     * @param $requestModelInput
     * @param $requestModelOutput
     * @return mixed
     */
    public function mapPropertiesModel($requestModelInput, $requestModelOutput)
    {

        foreach ($requestModelInput->getProperties() as $property) {
            $get = 'get'.ucfirst($property);
            $set = 'set'.ucfirst($property);
            if (method_exists($requestModelOutput, $set) && method_exists($requestModelInput, $get)) {
                $requestModelOutput->$set($requestModelInput->$get());
            }
        }

        return $requestModelOutput;
    }
}