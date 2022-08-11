<?php

declare(strict_types=1);

namespace App\Base\Models;

use Exception;
use Stripe\Exception\CardException;

class Card
{
    protected string $name;

    protected string $number;

    protected string $month;

    protected string $year;

    protected string $securityCode;

    public function name(): string
    {
        return $this->name;
    }

    public function number(): string
    {
        return $this->number;
    }

    public function month(): int
    {
        return (int) $this->month;
    }

    public function year(): int
    {
        return (int) $this->year;
    }

    public function securityCode(): string
    {
        return $this->securityCode;
    }

    /**
     * @param string $name
     * @param string $number
     * @param string $date
     * @param string $securityCode
     * @throws CardException
     */
    public function setCard(
        string $name,
        string $number,
        string $date,
        string $securityCode
    ): void {
        try {
            $this->name = $name;
            $this->number = $number;
            $this->securityCode = $securityCode;
            list($this->month, $this->year) = explode('/', $date);

            if (strlen($this->year) < 4) {
                $this->year = '20' . $this->year;
            }
        } catch (Exception $e) {
            throw new CardException();
        }
    }
}
