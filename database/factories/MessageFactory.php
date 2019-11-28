<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Message;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
use App\User;

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

$factory->define(Message::class, function (Faker $faker) {
    $users = $faker->randomElements(User::all()->pluck('id')->toArray(),2);
    return [
        'user_id' => $users[0],
        'receiver_id' => $users[1],
        'message' => $faker->realText(30),
    ];
});
