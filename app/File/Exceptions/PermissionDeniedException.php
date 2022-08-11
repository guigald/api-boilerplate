<?php

declare(strict_types=1);

namespace App\File\Exceptions;

use Exception;

class PermissionDeniedException extends Exception
{
    public function __construct()
    {
        $this->message = __('exceptions.file.permission-denied');
        $this->code = 403;

        parent::__construct($this->message, $this->code);
    }
}
