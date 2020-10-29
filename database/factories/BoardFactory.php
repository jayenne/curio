<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use Illuminate\Support\Str;
use App\Helpers\CuriousPeople\CuriousNum;

use App\Board;
use Faker\Generator as Faker;

$factory->define(Board::class, function (Faker $faker) {
    $sensitive_chance = config('seeder.posts.sensitive');
    $title = $faker->sentence($nbWords = 3, $variableNbWords = true);
    $tagsCount = CuriousNum::getRandomBias(config('seeder.boards.hashtags'));
    $date = $faker->dateTimeBetween($startDate = '-36 months', $endDate = 'now');
    $layout = array_keys(config('platform.database.boards.layouts.options'));
    $columns = array_keys(config('platform.database.boards.columns.options'));
    $orderby = array_keys(config('platform.database.boards.orderby.options'));
    $direction = $faker->boolean(50);

    return [
        'title' => $title,
        'body' => $faker->text($maxNbChars = 280),
        'sensitive'=> $faker->boolean($sensitive_chance),
        'layout' => $faker->randomElement($layout),
        'columns' => strval($faker->randomElement($columns)),
        'orderby' => $faker->randomElement($orderby),
        'direction' => $direction,
        'created_at' => $date,
        'updated_at' => $date,
    ];
});
