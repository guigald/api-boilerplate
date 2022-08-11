<?php

declare(strict_types=1);

namespace App\Base\Exceptions;

use Exception;

class UpdateException extends Exception
{
    public function __construct(string $message = '')
    {
        $this->message = !empty($message)
            ? $message
            : __('exceptions.generic.update');

        $this->code = 422;

        parent::__construct($this->message, $this->code);
    }
}
