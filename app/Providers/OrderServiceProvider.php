<?php

namespace App\Providers;

use App\Repositories\OrderRepository;
use App\Services\Api\OrderService;
use Illuminate\Support\ServiceProvider;

class OrderServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        app()->singleton(OrderService::class, function ($app) {
            return new OrderService(new OrderRepository());
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
