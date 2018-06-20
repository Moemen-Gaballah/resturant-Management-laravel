<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'role' => $faker->word,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Menu::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
        'type' => $faker->word,
        'description' => $faker->text,
        'status' =>  $faker->boolean,
        'image' => $faker->imageUrl($width = 640, $height = 480),
        'user_id' => $faker->numberBetween($min = 1, $max = 10),
    ];
});

$factory->define(App\Item::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
        'price' => $faker->randomFloat($nbMaxDecimals = NULL, $min = 10, $max = 100),
        'description' => $faker->text,
        'status' =>  $faker->boolean,
        'image' => $faker->imageUrl($width = 640, $height = 480),
        'user_id' => $faker->numberBetween($min = 1, $max = 10),
        'menu_id' => $faker->numberBetween($min = 1, $max = 50),
    ];
});

$factory->define(App\Meal::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
        'price' => $faker->randomFloat($nbMaxDecimals = NULL, $min = 10, $max = 100),
        'description' => $faker->text,
        'status' =>  $faker->boolean,
        'image' => $faker->imageUrl($width = 640, $height = 480),
        'user_id' => $faker->numberBetween($min = 1, $max = 10),
    ];
});


$factory->define(App\Customer::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'address' => $faker->address,
        'city' => $faker->city,
        'phone' => $faker->e164PhoneNumber,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
    ];
});

$factory->define(App\Order::class, function (Faker $faker) {
    return [
        'total' => $faker->randomFloat($nbMaxDecimals = NULL, $min = 10, $max = 100),
        'cashIn' => $faker->randomFloat($nbMaxDecimals = NULL, $min = 10, $max = 100),
        'payment' => $faker->randomFloat($nbMaxDecimals = NULL, $min = 10, $max = 100),
        'change' => $faker->randomFloat($nbMaxDecimals = NULL, $min = 10, $max = 100),
        'status' =>  $faker->boolean,
        'customer_id' => $faker->numberBetween($min = 1, $max = 10),
    ];
});

$factory->define(App\Comment::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
        'description' => $faker->text,
        'status' =>  $faker->boolean,
        'image' => $faker->imageUrl($width = 640, $height = 480),
        'customer_id' => $faker->numberBetween($min = 1, $max = 10),
        'order_id' => $faker->numberBetween($min = 1, $max = 100),
        'rate' => $faker->numberBetween($min = 1, $max = 5),
    ];
});

$factory->define(App\MealItem::class, function (Faker $faker) {
    return [
        'meal_id' => $faker->numberBetween($min = 1, $max = 100),
        'item_id' => $faker->numberBetween($min = 1, $max = 100),
        'discount' => $faker->numberBetween($min = 1, $max = 100),
    ];
});

$factory->define(App\OrderItem::class, function (Faker $faker) {
    return [
        'order_id' => $faker->numberBetween($min = 1, $max = 50),
        'item_id' => $faker->numberBetween($min = 1, $max = 50),
    ];
});

$factory->define(App\OrderMeal::class, function (Faker $faker) {
    return [
        'order_id' => $faker->numberBetween($min = 1, $max = 50),
        'meal_id' => $faker->numberBetween($min = 1, $max = 50),
    ];
});

$factory->define(App\OrderUser::class, function (Faker $faker) {
    return [
        'order_id' => $faker->numberBetween($min = 1, $max = 50),
        'user_id' => $faker->numberBetween($min = 1, $max = 50),
        'type' => $faker->word,
    ];
});