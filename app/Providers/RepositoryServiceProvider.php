<?php

namespace App\Providers;

use App\Repositories\ActionLogRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\Interfaces\ActionLogRepositoryInterface;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use App\Repositories\ProductRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
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
        $this->app->bind( CategoryRepositoryInterface::class, CategoryRepository::class );
        $this->app->bind( ProductRepositoryInterface::class, ProductRepository::class );
        $this->app->bind( ActionLogRepositoryInterface::class, ActionLogRepository::class );
    }
}
