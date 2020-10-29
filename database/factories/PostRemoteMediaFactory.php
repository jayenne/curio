<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\PostRemoteMedia;
use Faker\Generator as Faker;

$factory->define(PostRemoteMedia::class, function (Faker $faker) {
    return [
        'url' => $faker->imageUrl($width = 640, $height = 480), // 'http://lorempixel.com/640/480/'
        'title' => $faker->sentence($nbWords = 6, $variableNbWords = true),
        'alt' => $faker->sentence($nbWords = 4, $variableNbWords = true),
        'type' => 'other',
    ];
});
