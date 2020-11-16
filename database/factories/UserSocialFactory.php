<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\UserSocial;
use Faker\Generator as Faker;

$factory->define(UserSocial::class, function (Faker $faker) {
    $social_id = $faker->unique()->regexify('[A-Za-z0-9]{10}');

    $seed = $faker->numberBetween($min = 1, $max = 1080);
    $width = '150';
    $height = '150';
    $mods = ['greyscale', ''];
    $index = array_rand($mods);
    $mod = '?'.$mods[$index];
    $avatar = 'https://picsum.photos/id/'.$seed.'/'.$width.'/'.$height.$mod;

    return [
        //'user_id' => $faker->numberBetween($min = 1, $max = 50),
        'service' => 'twitter',
        'social_id' => $social_id,
        'token' => $faker->regexify('[A-Za-z0-9]{20}'),
        //'name' => $first_name.' '.$last_name,
        //'nickname' => $first_name.'_'.$social_id,
        'avatar' => $avatar,
    ];
});
