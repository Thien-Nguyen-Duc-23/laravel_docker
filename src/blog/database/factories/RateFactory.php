<?php

use Faker\Generator as Faker;
use App\Models\Book;
use App\Models\Rate;

$factory->define(Rate::class, function (Faker $faker) {
    return [
        'star' => rand(3, 5),
        'user_id' => 2,
        'book_id' => $faker->unique()->numberBetween(1, 10)
    ];
});
