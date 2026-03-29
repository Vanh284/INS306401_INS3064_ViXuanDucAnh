<?php
// classes/ValidationException.php

class ValidationException extends Exception
{
    private array $errors;

    public function __construct(array $errors, $message = "Lỗi xác thực dữ liệu", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->errors = $errors;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }
}