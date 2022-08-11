<?php

declare(strict_types=1);

namespace App\Auth\Exceptions;

use Exception;

class SpecialistNotValidatedException extends Exception
{
    public function __construct(string $message = '')
    {
        $this->message = !empty($message)
            ? $message
            : __('exceptions.auth.specialist-not-validated');

        $this->code = 403;

        parent::__construct($this->message, $this->code);
    }
}
