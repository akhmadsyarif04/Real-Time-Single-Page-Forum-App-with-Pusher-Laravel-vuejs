<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Models\Reply;
use App\Models\Question;
use App\User;

use Faker\Generator as Faker;

$factory->define(Reply::class, function (Faker $faker) {
    return [
        'body' => $faker->text,
        'question_id' => function () {
          return Question::all()->random();
        },
        'user_id' => function () {
          return \App\User::all()->random();
        }
    ];
});
