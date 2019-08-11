<?php

use Faker\Generator as Faker;

$factory->define(App\Bank::class, function (Faker $faker) {
    return [
        //
        'bank_name' => $faker->randomElement(['Union Bank', 'FCMB','UBA','Zenith bank','Fidelity Bank','Keystone','GTB Bank','Unity Bank','Acess Bank','Polaris  Bank','Stanbic Bank']),
        'bank_branch' => $faker->address,
        'sort_code' => $faker->unique()->numberBetween($min = 1, $max = 10000),
        'acct_name' => $faker->name(),
        'acct_number' => $faker->unique()->randomNumber($nbDigits = NULL, $strict = false),
    ];
});
