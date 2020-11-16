<?php

use Faker\Generator as Faker;
use Illuminate\Support\Str;
/** @var \Illuminate\Database\Eloquent\Factory $factory */
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

$factory->define(Permission::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'uuid' => $faker->unique()->uuid(),
    ];
});
