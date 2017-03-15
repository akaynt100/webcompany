<?php

namespace App\Providers;

use App\Repositories\Contracts\IOrderRepository;
use App\Repositories\Contracts\IResponseToOrderRepository;
use App\Repositories\Contracts\IUserRepository;
use App\Repositories\OrderRepository;
use App\Repositories\ResponseToOrderRepository;
use App\Repositories\UserRepository;
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
        if ($this->app->environment() !== 'production') {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        }

        $this->app->singleton(IOrderRepository::class, OrderRepository::class);
        $this->app->singleton(IResponseToOrderRepository::class, ResponseToOrderRepository::class);
        $this->app->singleton(IUserRepository::class, UserRepository::class);
    }
}
