<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Http\Controllers\Api\Role\RoleController;
use App\Http\Controllers\Api\Role\DashboardRoleController;
use App\Http\Controllers\Api\Role\RoleMenuController;
use App\Repo\Role\RoleInterface;
use App\Repo\Role\RoleRepository;
use App\Repo\Role\RoleMenuRepository;

class RoleServiceProvider extends ServiceProvider
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
        $this->app->when(RoleController::class)
        ->needs(RoleInterface::class)
        ->give(RoleRepository::class);

        $this->app->when(DashboardRoleController::class)
        ->needs(RoleInterface::class)
        ->give(RoleRepository::class);

        $this->app->when(RoleMenuController::class)
        ->needs(RoleInterface::class)
        ->give(RoleMenuRepository::class);


    }
}
