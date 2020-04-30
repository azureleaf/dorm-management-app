<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$faker = Faker\Factory::create('ja_JP');

$factory->define(Model::class, function (Faker $faker) {
    return [
        'user_id' => factory(App\User::class),
        'abstract' => "寮費請求",
        'billing' => $faker->numberBetween(0, 20000),
        'payment' => 0,
        'balance' => $faker->numberBetween(0, 20000),
    ];
});
