<?php

namespace App\Providers;

use App\Exceptions\ApiExceptionHandler;
use App\Services\AuthorService;
use App\Services\AuthService;
use App\Services\BookService;
use App\Services\Interfaces\AuthorServiceInterface;
use App\Services\Interfaces\AuthServiceInterface;
use App\Services\Interfaces\BookServiceInterface;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ExceptionHandler::class, ApiExceptionHandler::class);

        $this->app->bind(AuthServiceInterface::class, AuthService::class);
        $this->app->bind(BookServiceInterface::class, BookService::class);
        $this->app->bind(AuthorServiceInterface::class, AuthorService::class);
    }
}
