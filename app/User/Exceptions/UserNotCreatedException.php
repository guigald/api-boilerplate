<?php

declare(strict_types=1);

namespace App\User\Exceptions;

use Exception;

class UserNotCreatedException extends Exception
{
    public function __construct()
    {
        $this->message = __('exceptions.user.not-created');
        $this->code = 422;

        parent::__construct($this->message, $this->code);
    }
}
