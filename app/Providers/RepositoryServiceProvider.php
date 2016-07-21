<?php

namespace LaravelDelivery\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'LaravelDelivery\Repositories\CategoryRepository',
            'LaravelDelivery\Repositories\CategoryRepositoryEloquent'
        );

        $this->app->bind(
            'LaravelDelivery\Repositories\ClientRepository',
            'LaravelDelivery\Repositories\ClientRepositoryEloquent'
        );

        $this->app->bind(
            'LaravelDelivery\Repositories\OrderRepository',
            'LaravelDelivery\Repositories\OrderRepositoryEloquent'
        );

        $this->app->bind(
            'LaravelDelivery\Repositories\OrderItemRepository',
            'LaravelDelivery\Repositories\OrderItemRepositoryEloquent'
        );

        $this->app->bind(
            'LaravelDelivery\Repositories\ProductRepository',
            'LaravelDelivery\Repositories\ProductRepositoryEloquent'
        );

        $this->app->bind(
            'LaravelDelivery\Repositories\UserRepository',
            'LaravelDelivery\Repositories\UserRepositoryEloquent'
        );

        $this->app->bind(
            'LaravelDelivery\Repositories\CupomRepository',
            'LaravelDelivery\Repositories\CupomRepositoryEloquent'
        );
    }
}
