<?php

declare(strict_types=1);

namespace App\User\Exceptions;

use Exception;

class UserAlreadyExistsException extends Exception
{
    public function __construct()
    {
        $this->message = __('exceptions.user.already-exists');
        $this->code = 200;

        parent::__construct($this->message, $this->code);
    }
}
