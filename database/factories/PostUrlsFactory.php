<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\PostUrls;
use Faker\Generator as Faker;

$factory->define(PostUrls::class, function (Faker $faker) {
    return [
        'url' => $faker->url,
        'site' => '',
        'title' => '',
        'body' => '',
        'image' => '',
        'alt' => '',
        'locale' => '',
        'type' => '',
        'opengraph' => '',
    ];
});
