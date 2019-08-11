<?php
use App\Nok;
use Faker\Generator as Faker;

$factory->define(App\Nok::class, function (Faker $faker) {
    return [
        //
       
        'title' => $faker->title,
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'other_name' => $faker->optional()->lastName,
        'gender' => $faker->randomElement(['male', 'female']),
        'relationship' => $faker->randomElement(['Father', 'Child','Spouse']),
        'phone' => $faker->phoneNumber,
        'email' => $faker->unique()->safeEmail,    
    ];
});
