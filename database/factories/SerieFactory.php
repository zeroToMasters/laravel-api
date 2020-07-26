<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Serie;
use Faker\Generator as Faker;

$factory->define(Serie::class, function (Faker $faker) {
    return [
        'titulo' => $faker->title(),
        'thumbnail' => $faker->imageUrl(),
        'resumen' => $faker->paragraph(),
    ];
});
