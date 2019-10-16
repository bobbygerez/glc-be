<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Http\Controllers\Api\Menu\MenuController;
use App\Repo\Menu\MenuInterface;
use App\Repo\Menu\MenuRepository;

class MenuServiceProvider extends ServiceProvider
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
        $this->app->when(MenuController::class)
        ->needs(MenuInterface::class)
        ->give(MenuRepository::class);
    }
}
