<?php
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
/** @var \Illuminate\Database\Eloquent\Factory $factory */
use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(Permission::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'uuid' => $faker->unique()->uuid()
    ];
});