<?php

use Faker\Generator as Faker;

$factory->define(App\Targetsaving::class, function (Faker $faker) {
    return [
        //
        'amount' => $faker->randomFloat($nbMaxDecimals = 3, $min = 0, $max = NULL),
        'entry_date' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'created_by' => $faker->randomElement(['1','2','3']),
    ];
});
