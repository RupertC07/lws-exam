<?php

namespace App\Providers;

use App\Interfaces\AnimeInterface;
use App\Interfaces\UserInterface;
use App\Repositories\AnimeRepo;
use App\Repositories\UserRepo;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserInterface::class, UserRepo::class);
        $this->app->bind(AnimeInterface::class, AnimeRepo::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
