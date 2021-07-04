<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */


use Faker\Generator as Faker;

$factory->define(\App\Models\Card::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'limit' => $faker->numberBetween(1500,5000),
        'type' => $faker->title,
        'user_id' =>  1

    ];
});
