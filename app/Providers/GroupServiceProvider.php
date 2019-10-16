<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Http\Controllers\Api\Group\GroupController;
use App\Repo\Group\GroupInterface;
use App\Repo\Group\GroupRepository;

class GroupServiceProvider extends ServiceProvider
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
         $this->app->when(GroupController::class)
        ->needs(GroupInterface::class)
        ->give(GroupRepository::class);
    }
}
