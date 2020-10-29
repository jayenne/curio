<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\UserProfile;
use Faker\Generator as Faker;
use App\Helpers\CuriousPeople\CuriousNum;

$factory->define(UserProfile::class, function (Faker $faker) {
    $sex = CuriousNum::getClosestElementByValue(
        config('seeder.users.sex'),
        rand(0, 100)
    );

    $gender = CuriousNum::getClosestElementByValue(
        config('seeder.users.gender'),
        rand(1, 1000)/10
    );

    return [
        'sex' => $sex,
        'gender' => $gender,
        'location' => Str::limit($faker->address(), 29, $end="…"),
        'title' => Str::limit($faker->paragraph($nbSentences = 1, $variableNbSentences = false), 49, $end='…'),
        'body' => Str::limit($faker->paragraph($nbSentences = 4, $variableNbSentences = true), 159, $end='…')
    ];
});
