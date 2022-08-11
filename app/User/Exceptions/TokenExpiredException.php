<?php

declare(strict_types=1);

namespace App\User\Exceptions;

use Exception;

class TokenExpiredException extends Exception
{
    public function __construct()
    {
        $this->message = __('exceptions.token.expired');
        $this->code = 401;

        parent::__construct($this->message, $this->code);
    }
}
