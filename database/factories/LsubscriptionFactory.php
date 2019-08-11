<?php

use Faker\Generator as Faker;

$factory->define(App\Lsubscription::class, function (Faker $faker) {
    return [
        //
        'loan_id'=>$faker->randomElement(['1','2','3','4']),
        'user_id'=>$faker->randomElement(['1','2','3']),
        'custom_tenor' => $faker->unique()->randomNumber($nbDigits = NULL, $strict = false),
        'amount_applied' => $faker->numberBetween($min = 1, $max = 10000000),
        'amount_approved' => $faker->numberBetween($min = 1, $max = 10000000),
        'monthly_deduction' => $faker->numberBetween($min = 1, $max = 10000000),
        'net_pay' => $faker->numberBetween($min = 1, $max = 10000000),
        'loan_start_date' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'loan_end_date' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'review_comment' => $faker->sentence($nbWords = 6, $variableNbWords = true), 
        'created_by'=>$faker->randomElement(['1','2','3']),
    ];
});
