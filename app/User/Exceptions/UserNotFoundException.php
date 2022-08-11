<?php

declare(strict_types=1);

namespace App\User\Exceptions;

use Exception;

class UserNotFoundException extends Exception
{
    public function __construct()
    {
        $this->message = __('exceptions.user.not-found');
        $this->code = 404;

        parent::__construct($this->message, $this->code);
    }
}
