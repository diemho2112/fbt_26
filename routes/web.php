<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Route;

Route::get('/', 'TourController@index')->name('home');

Route::group(['prefix' => 'admin', 'middleware' => ['admin', 'auth'], 'namespace' => 'Admin'], function () {
    Route::get('/', 'TourController@index')->name('admin.home');

    Route::resource('tour', 'TourController')->names([
        'index' => 'tour.list',
    ])->except('show');

    Route::resource('booking', 'BookingController')->names([
        'index' => 'booking.list',
        'destroy' => 'booking.delete'
    ])->only('index', 'destroy');

    Route::resource('user', 'UserController')->names([
        'index' => 'user.list',
        'destroy' => 'user.delete'
    ])->only('index', 'destroy');

    Route::post('tour/search', 'TourController@searchName')->name('tour.search.name');
    Route::get('/revenue', 'TourController@showRevenue')->name('revenue');
    Route::post('/revenue', 'TourController@revenueByMonth')->name('revenue.month');
    Route::get('/export/bookings/daily', 'BookingController@dailyExport');
    Route::get('/export/bookings/monthly', 'BookingController@monthlyExport');
    Route::get('/booking/{id}/accept', 'BookingController@acceptBooking')->name('booking.accept');
    Route::get('/booking/{id}/reject', 'BookingController@rejectBooking')->name('booking.reject');
});

Route::group(['middleware' => 'auth'], function () {
    Route::resource('user', 'UserController')
        ->only('show', 'edit', 'update');

    Route::resource('tour.booking', 'TourBookingController')
        ->only('store');

    Route::resource('booking', 'BookingController')
        ->except('store', 'show');

    Route::resource('review', 'ReviewController');

    Route::post('/comment', 'ReviewController@comment')->name('comment');
    Route::post('booking/{id}/cancel', 'BookingController@cancel')->name('booking.cancel');
    Route::get('/cancel', 'BookingController@canceledList')->name('booking.cancelList');
    Route::post('/booking/{id}/restore', 'BookingController@restore')->name('booking.restore');
    Route::post('/tour/rate', 'TourController@rate')->name('tour.rate');
    Route::post('/review/like', 'ReviewController@like')->name('like');
    Route::get('/notifications', 'UserController@notifications')->name('notifications');
});

Route::resource('tour', 'TourController')
    ->only('show', 'index');

Route::get('/login/{social}', 'Auth\LoginController@redirectToProvider')->name('social-login');
Route::get('/login/{social}/callback', 'Auth\LoginController@handleProviderCallback');
Auth::routes();
Route::post('/tour/search', 'TourController@search')->name('tour.search');
Route::get('/latest', 'TourController@showLatestTours')->name('tour.latest');
Route::get('/best', 'TourController@showBestTours')->name('tour.best');
Route::get('/popular', 'TourController@showPopularTours')->name('tour.popular');
