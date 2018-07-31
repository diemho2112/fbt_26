<?php

use Faker\Generator as Faker;

$factory->define(App\Models\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => bcrypt('secret'),
        'date_of_birth' => $faker->date(),
        'gender' => $faker->randomElement(['male', 'female']),
        'address' => $faker->address,
        'phone' => $faker->phoneNumber,
        'is_admin' => false,
        'remember_token' => str_random(10),
    ];
});

$factory->defineAs(App\Models\User::class, 'admin', function ($faker) use ($factory) {
    $user = $factory->raw('App\Models\User');

    return array_merge($user, ['is_admin' => true]);
});

$factory->define(App\Models\Social_account::class, function (Faker $faker) {
    return [
        'user_id' => App\Models\User::all('id')->random(),
        'provider' => $faker->randomElement(['facebook', 'google', 'twitter']),
        'provider_id' => str_random(10),
    ];
});

$factory->define(App\Models\Tour::class, function (Faker $faker) {
    return [
        'name' => $faker->title,
        'duration' => $faker->numberBetween(0, 30),
        'itinerary' => $faker->country,
        'start_date' => $faker->date(),
        'price' => $faker->randomFloat(2, 100, 1000),
        'desciption' => $faker->text,
        'image' => $faker->imageUrl(),
    ];
});

$factory->define(App\Models\Booking::class, function (Faker $faker) {
    return [
        'user_id' => App\Models\User::all('id')->random(),
        'tour_id' => App\Models\Tour::all('id')->random(),
        'number_of_passengers' => rand(0, 50),
        'grand_total' => $faker->randomFloat(2, 100, 10000),
        'is_canceled' => $faker->boolean,
        'booking_date' => $faker->dateTime(),
    ];
});

$factory->define(App\Models\Package::class, function (Faker $faker) {
    return [
        'tour_id' => App\Models\Tour::all('id')->random(),
        'name' => $faker->title,
        'desciption' => $faker->text(),
        'discount' => $faker->numberBetween(0, 100),
    ];
});

$factory->define(App\Models\Activity::class, function (Faker $faker) {
    return [
        'tour_id' => App\Models\Tour::all('id')->random(),
        'name' => $faker->title,
        'description' => $faker->text(),
    ];
});

$factory->define(App\Models\Rating::class, function (Faker $faker) {
    return [
        'user_id' => App\Models\User::all('id')->random(),
        'tour_id' => App\Models\Tour::all('id')->random(),
        'value' => $faker->numberBetween(1, 5),
    ];
});

$factory->define(App\Models\Review::class, function (Faker $faker) {
    return [
        'user_id' => App\Models\User::all('id')->random(),
        'tour_id' => App\Models\Tour::all('id')->random(),
        'title' => $faker->text,
        'content' => $faker->paragraph,
    ];
});

$factory->define(App\Models\Like::class, function (Faker $faker) {
    return [
        'user_id' => App\Models\User::all('id')->random(),
        'review_id' => App\Models\Review::all('id')->random(),
        'is_disliked' => $faker->boolean,
    ];
});

$factory->define(App\Models\Comment::class, function (Faker $faker) {
    return [
        'user_id' => App\Models\User::all('id')->random(),
        'content' => $faker->paragraph,
        'commentable_id' => App\Models\Review::all('id')->random(),
        'commentable_type' => 'reviews',
    ];
});

$factory->defineAs(App\Models\Comment::class, 'reply', function ($faker) use ($factory) {
    $user = $factory->raw('App\Models\Comment');

    return array_merge($user, [
        'commentable_id' => App\Models\Comment::all('id')->random(),
        'commentable_type' => 'comments',
    ]);
});
