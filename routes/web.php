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

Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function () {
    Route::get('/', 'Admin\TourController@index')->name('admin.home');

    Route::resource('tour', 'Admin\TourController')->names([
        'index' => 'tour.list',
    ])->except('show');

    Route::resource('booking', 'Admin\BookingController')->names([
        'index' => 'booking.list',
        'destroy' => 'booking.delete'
    ])->only('index', 'destroy');

    Route::resource('user', 'Admin\UserController')->names([
        'index' => 'user.list',
        'destroy' => 'user.delete'
    ])->only('index', 'destroy');

    Route::post('tour/search', 'Admin\TourController@searchName')->name('tour.search.name');
    Route::get('/revenue', 'Admin\TourController@showRevenue')->name('revenue');
    Route::post('/revenue', 'Admin\TourController@revenueByMonth')->name('revenue.month');
});

Route::resource('user', 'UserController')->only('show', 'edit', 'update');

Route::resource('tour', 'TourController')->only('show', 'index');

Route::resource('tour.booking', 'TourBookingController')->only('store');

Route::resource('booking', 'BookingController')->except('store', 'show');

Route::get('/login/{social}', 'Auth\LoginController@redirectToProvider')->name('social-login');

Route::get('/login/{social}/callback', 'Auth\LoginController@handleProviderCallback');

Auth::routes();

Route::post('booking/{id}/cancel', 'BookingController@cancel')->name('booking.cancel');
Route::get('/cancel', 'BookingController@canceledList')->name('booking.cancelList');
Route::post('/booking/{id}/restore', 'BookingController@restore')->name('booking.restore');
Route::post('/tour/search', 'TourController@search')->name('tour.search');
Route::post('/tour/{id}/rate', 'TourController@rate')->name('tour.rate');
Route::get('/review/{id}/like', 'LikeController@like')->name('like');
Route::get('/review/{id}/dislike', 'LikeController@dislike')->name('dislike');
Route::post('/tour/{id}/review', 'TourController@review')->name('tour.review');
Route::get('/latest', 'TourController@showLatestTours')->name('tour.latest');
Route::get('/best', 'TourController@showBestTours')->name('tour.best');
Route::get('/popular', 'TourController@showPopularTours')->name('tour.popular');
Route::post('/search', 'TourController@search')->name('tour.search');
