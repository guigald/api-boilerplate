<?php

declare(strict_types=1);

namespace App\Infrastructure\External\Payment\Stripe\Exceptions;

use Exception;

class StripeException extends Exception
{
    public function __construct($message = '')
    {
        $this->message = !empty($message)
            ? __('stripe.exceptions.' . $message)
            : __('stripe.exceptions.generic');

        $this->code = 422;

        parent::__construct($this->message, $this->code);
    }
}
