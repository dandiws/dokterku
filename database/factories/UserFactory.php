<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Reply;
use App\Thread;
use App\User;
use App\Channel;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

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

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'type' => $faker->randomElement(['user','doctor']),
        'remember_token' => Str::random(10),
    ];
});


$factory->define(Thread::class, function (Faker $faker) {
    return [
        'user_id' => function(){
            return factory('App\User')->create()->id; 
        },
        'channel_id' => function(){
            return factory('App\Channel')->create()->id;
        },
        'title' => $faker->sentence,
        'description' => $faker->paragraph
    ];
});

$factory->define(Reply::class, function (Faker $faker) {
    return [
        'user_id' => function(){
            return factory('App\User')->create()->id; 
        },
        'thread_id' => function(){
            return factory('App\Thread')->create()->id; 
        },
        'description' => $faker->paragraph
    ];
});


$factory->define(Channel::class, function (Faker $faker){
    $name = $faker->word;
    
    return [
        'user_id' => function(){
            return factory('App\User')->create()->id; 
        },
        'channel_id' => function(){
            return factory('App\Channel')->create()->id;
        },
        'name' => $name,
        'slug' => $name
    ];
});

$factory->afterCreating(App\User::class, function ($user, $faker) {
    if($user->type=='doctor'){
        DB::table('doctor_details')->insert([
            'user_id'=>$user->id,
            'specialization_id'=> DB::table('specializations')->inRandomOrder()->first()->id,
            'address'=>$faker->address,
        ]);
    }
});

