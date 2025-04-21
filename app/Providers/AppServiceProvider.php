<?php

namespace App\Providers;

use App\Repositories\TagRepository;
use App\Repositories\ReviewRepository;
use App\Repositories\ServiceRepository;
use Illuminate\Support\ServiceProvider;
use App\Repositories\CategoryRepository;
use App\Interfaces\TagRepositoryInterface;
use App\Interfaces\ServiceRepositoryInterface;
use App\Interfaces\CategoryRepositoryInterface;
use App\Interfaces\ReviewRepositoryInterface;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(TagRepositoryInterface::class, TagRepository::class);
        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
        $this->app->bind(ServiceRepositoryInterface::class, ServiceRepository::class);
        $this->app->bind(ReviewRepositoryInterface::class, ReviewRepository::class);



    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
