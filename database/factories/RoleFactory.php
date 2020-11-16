<?php

use Faker\Generator as Faker;
/** @var \Illuminate\Database\Eloquent\Factory $factory */
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

$factory->define(Role::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'uuid' => $faker->unique()->uuid(),
    ];
});
