<?php

use Faker\Generator as Faker;
use App\Models\Book;
use App\Models\UserInformation;
use App\Models\Bookmart;

$factory->define(Bookmart::class, function (Faker $faker) {
    return [
        'user_id' => UserInformation::all()->random()->id,
        'book_id' => Book::all()->random()->id,
    ];
});
