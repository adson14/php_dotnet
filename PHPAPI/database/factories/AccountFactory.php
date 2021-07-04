<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Models\Account::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'account_number'=>$faker->numberBetween(1000,9000),
        'user_id' =>  1
    ];
});
//'user_id' =>  function () { return factory(App\User::class)->create()->user_id;}
