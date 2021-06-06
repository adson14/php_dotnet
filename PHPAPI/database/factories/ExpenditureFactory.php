<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */


use Faker\Generator as Faker;

$factory->define(\App\Models\Expenditure::class, function (Faker $faker) {
    return [
        'description'=>$faker->domainName,
        'value'=>$faker->numberBetween(1,1000000),
        'date_expenditure'=>$faker->date(),
        'repeat' => 'S',
        'user_id' =>  function () { return factory(App\User::class)->create()->user_id;},
        'card_id' =>  function () { return factory(App\Models\Card::class)->create()->card_id;},
        'category_id' =>  function () { return factory(App\Models\Category::class)->create()->category_id;},
        'account_id' =>  function () { return factory(App\Models\Account::class)->create()->account_id;}
    ];
});
