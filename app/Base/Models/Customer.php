<?php

declare(strict_types=1);

namespace App\Base\Models;

class Customer
{
    protected string $name;

    protected string $phone;

    protected string $email;

    public function name(): string
    {
        return $this->name;
    }

    public function phone(): string
    {
        return $this->phone;
    }

    public function email(): string
    {
        return $this->email;
    }

    /**
     * @param string $name
     * @param string $phone
     * @param string $email
     */
    public function setCustomer(
        string $name,
        string $phone,
        string $email
    ): void {
        $this->name = $name;
        $this->phone = $phone;
        $this->email = $email;
    }
}
