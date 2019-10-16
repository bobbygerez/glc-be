<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Http\Controllers\Api\Payment\PaymentController;
use App\Repo\Payment\PaymentInterface;
use App\Repo\Payment\PaymentRepository;
use App\Repo\Payment\PaymentMenuRepository;

class PaymentServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->when(PaymentController::class)
        ->needs(PaymentInterface::class)
        ->give(PaymentRepository::class);
    }
}
