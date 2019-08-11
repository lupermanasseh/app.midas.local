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
        'payment_number' => $faker->unique()->randomNumber($nbDigits = NULL, $strict = false),
        'title' => $faker->title,
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'other_name' => $faker->optional()->lastName,
        'sex' => $faker->randomElement(['male', 'female']),
        'staff_no' => $faker->numberBetween($min = 1, $max = 9000),
        'dept' => $faker->randomElement(['Administration', 'Finance','Records','Procurement','Nursing','O&G']),
        'phone' => $faker->phoneNumber,
        'marital_status' => $faker->randomElement(['Married', 'Single','Widower','Divorce','Window']),
        'home_add' => $faker->address,
        'res_add' => $faker->address,
        'dob' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'employ_type' => $faker->randomElement(['Permanent', 'Contract']),
        'job_cadre' => $faker->randomElement(['Junior Staff', 'Senior Staff']),
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
    ];
});
