<?php

use Faker\Generator as Faker;

$factory->define(App\Loan::class, function (Faker $faker) {
    return [
        //
        'description' => $faker->text($maxNbChars = 10),
        'tenor' => $faker->randomDigitNotNull,
        'interest' => $faker->randomDigitNotNull,
    ];
});
