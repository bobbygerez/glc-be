<?php

namespace App\Providers;

use Laravel\Passport\Passport;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model\Category' => 'App\Policies\CategoryPolicy',
        'App\Model\Role' => 'App\Policies\RolePolicy',
        'App\Model\User' => 'App\Policies\UserPolicy',
        'App\Model\Product' => 'App\Policies\ProductPolicy',
        'App\Model\Branch' => 'App\Policies\BranchPolicy',
        'App\Model\Payment' => 'App\Policies\PaymentPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Passport::routes();
        Gate::resource('users', 'App\Policies\UserPolicy');
        Gate::resource('dashboard_products', 'App\Policies\ProductPolicy');
        Gate::resource('dashboard_role', 'App\Policies\RolePolicy');
        Gate::resource('dashboard_categories', 'App\Policies\CategoryPolicy');
        Gate::resource('branches', 'App\Policies\BranchPolicy');
        Gate::resource('payments', 'App\Policies\PaymentPolicy');
    }
}
