<?php

declare(strict_types=1);

namespace App\Auth\Exceptions;

use Exception;

class UnauthorizedException extends Exception
{
    public function __construct(string $message = '')
    {
        $this->message = !empty($message)
            ? $message
            : __('exceptions.auth.unauthorized');

        $this->code = 401;

        parent::__construct($this->message, $this->code);
    }
}
