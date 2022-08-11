<?php

declare(strict_types=1);

namespace App\User\Exceptions;

use Exception;

class SpecialistAlreadyExistsException extends Exception
{
    public function __construct()
    {
        $this->message = __('exceptions.specialist.already-exists');
        $this->code = 200;

        parent::__construct($this->message, $this->code);
    }
}
