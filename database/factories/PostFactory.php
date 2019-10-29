<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Posts;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(Posts::class, function (Faker $faker) {
    return [
        'category_id' => 1,
        'title' => $faker->unique()->name,
        'text' => $faker->text,
        'tags' => $faker->words($nb = 3, $asText = false),
    ];
});
