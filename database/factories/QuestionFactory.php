<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Models\Question;
use App\Models\Category;
use App\User;

use Faker\Generator as Faker;

$factory->define(Question::class, function (Faker $faker) {
    $title = $faker->sentence;
    return [
      'title' => $title,
      'slug' => str_slug($title),
      'body' => $faker->text,
      'category_id' => function () {
        return Category::all()->random();
      },
      'user_id' => function () {
        return User::all()->random();
      }
    ];
});
