<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
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
        $this->app->bind(
            'App\Repositories\Booking\BookingRepositoryInterface',
            'App\Repositories\Booking\BookingEloquentRepository'
        );

        $this->app->bind(
            'App\Repositories\User\UserRepositoryInterface',
            'App\Repositories\User\UserEloquentRepository'
        );

        $this->app->bind(
            'App\Repositories\Tour\TourRepositoryInterface',
            'App\Repositories\Tour\TourEloquentRepository'
        );

        $this->app->bind(
            'App\Repositories\Review\ReviewRepositoryInterface',
            'App\Repositories\Review\ReviewEloquentRepository'
        );
    }
}
