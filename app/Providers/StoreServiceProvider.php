<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Http\Controllers\Api\Store\StoreController;
use App\Repo\Store\StoreInterface;
use App\Repo\Store\StoreRepository;

class StoreServiceProvider extends ServiceProvider
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
        $this->app->when(StoreController::class)
        ->needs(StoreInterface::class)
        ->give(StoreRepository::class);
    }
}
