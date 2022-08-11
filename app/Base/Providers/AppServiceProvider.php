<?php

namespace App\Base\Providers;

use App\Infrastructure\External\Payment\PaymentInterface;
use App\Infrastructure\External\Payment\Stripe\Client;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(PaymentInterface::class, Client::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        //
    }
}
