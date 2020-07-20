<?php

namespace App\Providers;

use App\src\Domain\Article\Repository\ArticleRepositoryInterface;
use App\src\Domain\Category\Repository\CategoryRepositoryInterface;
use App\src\Infrastructure\Article\Repository\ArticleRepository;
use App\src\Infrastructure\Category\Repository\CategoryRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            CategoryRepositoryInterface::class,
            CategoryRepository::class
            );

        $this->app->bind(
            ArticleRepositoryInterface::class,
            ArticleRepository::class
            );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
