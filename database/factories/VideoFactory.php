<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Video;
use Faker\Generator as Faker;

$factory->define(Video::class, function (Faker $faker) {
    return [
        'titulo' => $faker->title(),
        'descripcion' => $faker->paragraph(),
        'url_video' => $faker->url(),
    ];
});
