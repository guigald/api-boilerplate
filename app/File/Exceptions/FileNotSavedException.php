<?php

declare(strict_types=1);

namespace App\File\Exceptions;

use Exception;

class FileNotSavedException extends Exception
{
    public function __construct()
    {
        $this->message = __('exceptions.file.not-saved');
        $this->code = 400;

        parent::__construct($this->message, $this->code);
    }
}
