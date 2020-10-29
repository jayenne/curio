<?php
use Spatie\Permission\Models\Role;
/** @var \Illuminate\Database\Eloquent\Factory $factory */
use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(Role::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'uuid' => $faker->unique()->uuid()
    ];
});