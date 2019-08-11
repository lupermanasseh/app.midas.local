<?php

use Faker\Generator as Faker;

$factory->define(App\Product::class, function (Faker $faker) {
    return [
        //
        'name' => $faker->word,
        'description' => $faker->text($maxNbChars = 10),
        'unit_cost' => $faker->numberBetween($min = 1, $max = 9000),
    ];
});
