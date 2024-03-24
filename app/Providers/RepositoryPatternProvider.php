<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryPatternProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->app->bind(
            \App\Repositories\Product\ProductRepository::class,
            \App\Repositories\Product\ProductRepositoryImplement::class,
        );

        $this->app->bind(
            \App\Repositories\User\UserRepository::class,
            \App\Repositories\User\UserRepositoryImplement::class,
        );
    }
}
