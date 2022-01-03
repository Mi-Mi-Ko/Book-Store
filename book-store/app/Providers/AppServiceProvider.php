<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Repositories\User\UserInterface;
use App\Repositories\Book\BookInterface;
use App\Repositories\User\UserRepository;
use App\Repositories\Book\BookRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->bind(UserInterface::class, UserRepository::class);
        $this->app->bind(BookInterface::class, BookRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Schema::defaultStringLength(191);
    }
}
