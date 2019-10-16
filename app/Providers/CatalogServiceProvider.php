<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Http\Controllers\Api\Catalog\CatalogController;
use App\Repo\Catalog\CatalogInterface;
use App\Repo\Catalog\CatalogRepository;

class CatalogServiceProvider extends ServiceProvider
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
        $this->app->when(CatalogController::class)
        ->needs(CatalogInterface::class)
        ->give(CatalogRepository::class);
    }
}
