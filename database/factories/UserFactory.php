<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\User;
use Illuminate\Support\Str;
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

$factory->define(User::class, function (Faker $faker) {
    return [
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', //password
        'user_id' => random_int(10000, 1000000),
        'firstname' => $faker->firstName,
        'lastname' => $faker->lastName,
        'phone_number' => '090'.random_int(10000000, 99999999),
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'ref_id' => 1000000,
        'remember_token' => Str::random(10),
    ];
});
