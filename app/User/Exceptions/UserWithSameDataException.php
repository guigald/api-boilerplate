<?php

declare(strict_types=1);

namespace App\User\Exceptions;

use Exception;

class UserWithSameDataException extends Exception
{
    public function __construct()
    {
        $this->message = __('exceptions.user.same-data');
        $this->code = 422;

        parent::__construct($this->message, $this->code);
    }
}
