<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Entities\Stock;
use Faker\Generator as Faker;

$factory->define(Stock::class, function (Faker $faker) {
    return [
        'price' => floatval($faker->randomFloat()),
        'start_date' => $faker->dateTime()
    ];
});
