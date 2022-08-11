<?php

declare(strict_types=1);

namespace App\User\Exceptions;

use Exception;

class DuplicatedInformationException extends Exception
{
    public function __construct()
    {
        $this->message = __('exceptions.user.duplicated-information');
        $this->code = 400;

        parent::__construct($this->message, $this->code);
    }
}
