<?php

declare(strict_types=1);

namespace App\Infrastructure\External\Payment\Stripe;

use App\Base\Models\Card;
use App\Base\Models\Customer;
use App\Infrastructure\External\Payment\PaymentInterface;
use App\Infrastructure\External\Payment\Stripe\Exceptions\StripeException;
use Stripe\Customer as StripeCustomer;
use Stripe\Exception\ApiErrorException;
use Stripe\PaymentIntent;
use Stripe\PaymentMethod;
use Stripe\StripeClient;

class Client implements PaymentInterface
{
    public function __construct(private StripeClient $client)
    {
        $this->client = new StripeClient(env('STRIPE_CLIENT'));
    }

    /**
     * @param Card $card
     * @param int $value
     * @param bool $installment
     * @param int|null $amountInstallments
     * @param Customer $customer
     * @param string $productDescription
     * @return string
     * @throws StripeException
     */
    public function payment(
        Card $card,
        int $value,
        bool $installment,
        ?int $amountInstallments,
        Customer $customer,
        string $productDescription
    ): string {
        try {
            $paymentMethod = $this->getPaymentMethod($card);
            $paymentCustomer = $this->getPaymentCustomer($customer);

            $paymentIntent = $this->getPaymentIntent(
                $value,
                $paymentCustomer,
                $productDescription
            );

            $payment = $this->confirmPayment($paymentMethod, $paymentIntent);

            return json_encode($payment);
        } catch (ApiErrorException $e) {
            throw new StripeException(data_get($e->getError(), 'code'));
        }
    }

    /**
     * @param string $paymentIntent
     * @return string
     * @throws StripeException
     */
    public function refund(string $paymentIntent): string
    {
        try {
            $refund = $this->client->refunds->create([
                'payment_intent' => $paymentIntent,
            ]);

            return json_encode($refund);
        } catch (ApiErrorException $e) {
            throw new StripeException(data_get($e->getError(), 'code'));
        }
    }

    /**
     * @param Card $card
     * @return PaymentMethod
     * @throws ApiErrorException
     */
    private function getPaymentMethod(Card $card): PaymentMethod
    {
        return $this->client->paymentMethods->create([
            'type' => 'card',
            'card' => [
                'number' => $card->number(),
                'exp_month' => $card->month(),
                'exp_year' => $card->year(),
                'cvc' => $card->securityCode(),
            ],
        ]);
    }

    /**
     * @param int $value
     * @param StripeCustomer $customer
     * @param string $productDescription
     * @return PaymentIntent
     * @throws ApiErrorException
     */
    private function getPaymentIntent(
        int $value,
        StripeCustomer $customer,
        string $productDescription
    ): PaymentIntent {
        return $this->client->paymentIntents->create([
            'amount' => $value,
            'currency' => 'brl',
            'payment_method_types' => ['card'],
            'customer' => data_get($customer, 'id'),
            'description' => $productDescription,
        ]);
    }

    /**
     * @param PaymentMethod $paymentMethod
     * @param PaymentIntent $paymentIntent
     * @return PaymentIntent
     * @throws ApiErrorException
     */
    private function confirmPayment(
        PaymentMethod $paymentMethod,
        PaymentIntent $paymentIntent
    ): PaymentIntent {
        return $this->client->paymentIntents->confirm(
            data_get($paymentIntent, 'id'),
            ['payment_method' => data_get($paymentMethod, 'id')]
        );
    }

    /**
     * @param Customer $customer
     * @return StripeCustomer
     * @throws ApiErrorException
     */
    private function getPaymentCustomer(Customer $customer): StripeCustomer
    {
        return $this->client->customers->create([
            'name' => $customer->name(),
            'phone' => $customer->phone(),
            'email' => $customer->email(),
        ]);
    }
}
