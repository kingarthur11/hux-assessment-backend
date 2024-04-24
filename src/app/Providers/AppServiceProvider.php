<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\IUserRepository;
use App\Repositories\UserRepository;
use App\Repositories\IUserContactsRepository;
use App\Repositories\UserContactsRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(IUserRepository::class, UserRepository::class);
        $this->app->bind(IUserContactsRepository::class, UserContactsRepository::class);
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
