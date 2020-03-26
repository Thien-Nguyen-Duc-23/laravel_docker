<?php

use Faker\Generator as Faker;
use App\Models\Book;
use App\Models\Account;
use App\Models\Category;

$factory->define(Book::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(10),
        'conver' => 'default.png',
        'isbn' => $faker->realText(rand(10, 20)),
        'author' => $faker->realText(rand(10, 20)),
        'discription' => $faker->realText(rand(20, 60)),
        'content' => $faker->realText(rand(30, 100)),
        'status' => config('define.active'),
        'slug' => str_replace('--', '-', strtolower(preg_replace('/[^a-zA-Z0-9]/', '-', trim($faker->sentence(5))))),
        'publisher_id' => rand(1,2),
        'category_id' => Category::all()->random()->id,
    ];
});
