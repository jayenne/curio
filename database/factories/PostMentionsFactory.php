<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\PostMentions;
use Faker\Generator as Faker;

$factory->define(PostMentions::class, function (Faker $faker) {
    return [
        //
        'social_id' => $faker->randomNumber(),
        'handle' => $faker->userName(),
    ];
});
