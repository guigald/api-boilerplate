<?php

namespace App\Infrastructure\External\Payment;

use App\Base\Models\Card;
use App\Base\Models\Customer;

interface PaymentInterface
{
    /**
     * @param Card $card
     * @param int $value
     * @param bool $installment
     * @param int|null $amountInstallments
     * @param Customer $customer
     * @param string $productDescription
     * @return string
     */
    public function payment(
        Card $card,
        int $value,
        bool $installment,
        ?int $amountInstallments,
        Customer $customer,
        string $productDescription
    ): string;

    /**
     * @param string $paymentIntent
     * @return string
     */
    public function refund(string $paymentIntent): string;
}
