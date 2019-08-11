<?php

use Faker\Generator as Faker;

$factory->define(App\Ldeduction::class, function (Faker $faker) {
    return [
        //
        'amount_deducted' => $faker->randomFloat($nbMaxDecimals = 3, $min = 0, $max = NULL),
        'entry_month' => $faker->date($format = 'Y-m-d', $max = 'now'),
    ];
});
