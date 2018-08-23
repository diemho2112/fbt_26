<?php

namespace App\Providers;

use App\Models\Booking;
use App\Observers\BookingObserver;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Relation::morphMap([
            'reviews' => 'App\Models\Review',
            'comments' => 'App\Models\Comment'
        ]);

        Booking::observe(BookingObserver::class);
    }

    public function register()
    {
        //
    }
}
