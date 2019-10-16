<?php

namespace App\Providers;
use Illuminate\Support\ServiceProvider;

use App\Http\Controllers\Api\Product\ProductController;
use App\Http\Controllers\Api\Product\CategoryProductController;
use App\Http\Controllers\Api\Product\SubCategoryProductController;
use App\Http\Controllers\Api\Product\DashboardProductController;

use App\Repo\SubCategory\SubCategoryInterface;
use App\Repo\SubCategory\SubCategoryRepository;

use App\Repo\Category\CategoryInterface;
use App\Repo\Category\CategoryRepository;

use App\Repo\Product\ProductInterface;
use App\Repo\Product\ProductRepository;
use App\Repo\Product\DashboardProductRepository;

class ProductServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->when(ProductController::class)
            ->needs(ProductInterface::class)
            ->give(ProductRepository::class);
        
            $this->app->when(DashboardProductController::class)
            ->needs(ProductInterface::class)
            ->give(ProductRepository::class);

        $this->app->when(CategoryProductController::class)
            ->needs(CategoryInterface::class)
            ->give(CategoryRepository::class);
        
        $this->app->when(SubCategoryProductController::class)
            ->needs(SubCategoryInterface::class)
            ->give(SubCategoryRepository::class);

        $this->app->when(DashboardProductController::class)
            ->needs(ProductInterface::class)
            ->give(DashboardProductRepository::class);
    }
}
