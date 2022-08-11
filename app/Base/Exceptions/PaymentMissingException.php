<?php

declare(strict_types=1);

namespace App\Base\Exceptions;

use Exception;

class PaymentMissingException extends Exception
{
    public function __construct(string $message = '')
    {
        $this->message = !empty($message)
            ? $message
            : __('exceptions.payment.missing');

        $this->code = 401;

        parent::__construct($this->message, $this->code);
    }
}
