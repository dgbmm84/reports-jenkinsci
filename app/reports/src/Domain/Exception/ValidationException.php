<?php

namespace App\Domain\Exception;

use Symfony\Component\Validator\ConstraintViolation;

class ValidationException extends \Exception
{
    public const MSG_VALIDATION_ERRORS = 'Validation errors were found';
    /**
     * @var ConstraintViolation[]
     */
    protected $errors;

    /**
     * ValidationException constructor.
     * @param ConstraintViolation[] $errors
     */
    public function __construct(array $errors)
    {
        $this->errors = $errors;
        parent::__construct(self::MSG_VALIDATION_ERRORS);
    }

    /**
     * @return ConstraintViolation[]
     */
    public function getErrors(): array
    {
        return $this->errors;
    }
}
