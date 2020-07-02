<?php

namespace App\Framework\Mapper;


use Symfony\Component\HttpFoundation\Request;

class RequestMapper
{

    /**
     * @param array $data
     * @param $requestClass
     * @return mixed
     * @throws \LogicException
     * @throws \UnexpectedValueException
     */
    public function map($requestClass, $data = [])
    {
        $requestModel = new $requestClass();
        if (!($data instanceof Request) && !\is_array($data)) {
            throw new \UnexpectedValueException('Wrong data type received.');
        }

        if ($data instanceof Request) {
            $params = json_decode($data->getContent(), true);
            $params = null !== $params ? array_merge($params, $data->query->all()) : $data->query->all();
        } else {
            $params = $data;
        }

        foreach ($params as $key => $property) {
            $set = 'set'.ucfirst($key);
            if (method_exists($requestModel, $set)) {
                $requestModel->$set($property ?? null);
            }
        }

        return $requestModel;
    }
}