<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;
use App\Helpers\CuriousPeople\CuriousNum;

$factory->define(Post::class, function (Faker $faker) {
    $seperator = '-';
    $rnum = $faker->unique()->randomNumber();
    $title = $faker->text($maxNbChars = 30);
    $sensitive_chance = config('seeder.posts.sensitive');
    $status_chance = config('seeder.posts.status');
    $postTypeOptions = config('platform.database.posts.types.options');
    $postTypeRandom = array_rand($postTypeOptions);
    $postThemeOptions = config('platform.database.posts.themes.options');
    $postThemeRandom = array_rand($postThemeOptions);
    $sourceOptions = config('seeder.posts.sources.options');
    $sourceRandom = array_rand($sourceOptions);
    $tagsCount = CuriousNum::getRandomBias(config('seeder.posts.tags'));
    $created_at = $faker->dateTimeBetween($startDate = '-36 months', $endDate = 'now');
    $posted_at = $faker->dateTimeBetween($created_at, $endDate = 'now');
    return [
        'user_id' => $rnum,
        'title' => $title,
        'notes' => $faker->text($maxNbChars = 280),
        'text' => Arr::random([$faker->text($maxNbChars = 280),null]),
        'text_alt' => Arr::random([$faker->text($maxNbChars = 280),null]),
        'sensitive' => $faker->boolean($chanceOfGettingTrue = $sensitive_chance),
        'lang'=> $faker->languageCode(),
        'type' => $postTypeOptions[$postTypeRandom],
        'source_id' => $rnum,
        'source_user_id' => $rnum,
        'source_platform_id'=> $sourceOptions[$sourceRandom],
        'source_permalink' => 'https://www.jayenne.com',
        'source_payload'=> 'seeder',
        'index'=> null,
        'index_x'=> null,
        'posted_at'=> $posted_at,
        'created_at' => $created_at,
        'updated_at' => $created_at,
    ];
});
