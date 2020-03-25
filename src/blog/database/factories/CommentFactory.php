<?php

use Faker\Generator as Faker;
use App\Models\Book;
use App\Models\Comment;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        'content' => $faker->text(),
        'user_id' => 2,
        'book_id' => Book::all()->random()->id,
        'status' => rand(0, 1)
    ];
});
