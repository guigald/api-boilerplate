<?php

declare(strict_types=1);

namespace App\File\Exceptions;

use Exception;

class FileNotFoundException extends Exception
{
    public function __construct()
    {
        $this->message = __('exceptions.file.not-found');
        $this->code = 404;

        parent::__construct($this->message, $this->code);
    }
}
