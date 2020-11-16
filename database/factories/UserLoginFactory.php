<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\User;
use App\UserLogin;
use Faker\Generator as Faker;

$factory->define(UserLogin::class, function (Faker $faker) {
    return [
            'ip' => '127.0.0.0',
            'iso_code' => 'US',
            'country' => 'United States',
            'city' => 'New Haven',
            'state' => 'CT',
            'state_name' => 'Connecticut',
            'postal_code' => '06510',
            'lat' => '41.31',
            'lon' => '-72.92',
            'timezone' => 'America/New_York',
            'continent' => 'NA',
            'currency' => 'USD',
            'default' => 1,
            'cached' => false,
    ];
});
