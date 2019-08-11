<?php

use Faker\Generator as Faker;

$factory->define(App\Targetsr::class, function (Faker $faker) {
    return [
        //
        'monthly_saving' => $faker->randomFloat($nbMaxDecimals = 3, $min = 0, $max = NULL),
        'start_date' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'end_date' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'review_by' => $faker->randomElement(['1','2','3']),
    ];
});
