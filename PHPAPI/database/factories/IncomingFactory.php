<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(\App\Models\Incoming::class, function (Faker $faker,$data) {
    return [
        'description'=>$faker->domainName,
        'value'=>$faker->numberBetween(1,1000000),
        'date_incoming'=>$faker->date(),
        'repeat' => 'S',
        'user_id' =>  1,
        'category_id' =>   $data['category_id'],
        'account_id' =>   $data['account_id']
    ];
});
