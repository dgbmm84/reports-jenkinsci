<?php

namespace App\Framework\Mapper;

use App\Framework\Model\Exception\Error;
use Symfony\Component\Validator\ConstraintViolation;

class ErrorMapper
{

    /**
     * @param ConstraintViolation[] $constraintViolations
     * @return array
     * @throws \Symfony\Component\Validator\Exception\MissingOptionsException
     * @throws \Symfony\Component\Validator\Exception\InvalidOptionsException
     * @throws \Symfony\Component\Validator\Exception\ConstraintDefinitionException
     */
    public function map($constraintViolations) : array
    {
        $errors = [];
        foreach ($constraintViolations as $constraintViolation) {
            $errors[] = new Error(
                sprintf('%s: %s', $constraintViolation->getPropertyPath(), $constraintViolation->getMessage()),
                \is_int($constraintViolation->getCode()) ?? null
            );
        }

        return $errors;
    }
}
