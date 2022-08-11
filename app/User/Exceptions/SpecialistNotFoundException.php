<?php

declare(strict_types=1);

namespace App\User\Exceptions;

use Exception;

class SpecialistNotFoundException extends Exception
{
    public function __construct()
    {
        $this->message = __('exceptions.specialist.not-found');
        $this->code = 404;

        parent::__construct($this->message, $this->code);
    }
}
