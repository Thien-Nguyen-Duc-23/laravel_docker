<?php

use Faker\Generator as Faker;
use App\Models\Contact;

$factory->define(Contact::class, function (Faker $faker) {
    return [
        'full_name' => $faker->sentence(10),
        'email' => $faker->safeEmail,
        'subject' => $faker->realText(rand(10, 20)),
        'message' => $faker->realText(rand(20, 40)),
        'status' => $faker->randomElement($array = array(0, 1)),
    ];
});
