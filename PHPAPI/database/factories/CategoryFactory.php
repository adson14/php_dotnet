<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Category;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'type' => $faker->title,
        'color' => '#FFFAAA',
        'user_id' =>  function () { return factory(App\User::class)->create()->user_id;}
    ];
});
