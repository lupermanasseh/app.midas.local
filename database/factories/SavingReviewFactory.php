<?php

use Faker\Generator as Faker;

$factory->define(App\Savingreview::class, function (Faker $faker) {
    return [
        //
        'prev_amount' => $faker->randomFloat($nbMaxDecimals = 3, $min = 0, $max = NULL),
        'current_amount' => $faker->randomFloat($nbMaxDecimals = 3, $min = 0, $max = NULL),
        'created_by' =>$faker->randomElement(['1','2','3']),
    ];
});
