<?php

namespace Database\Factories;

use App\Helpers\CuriousPeople\CuriousNum;
use App\Post;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $seperator = '-';
        $rnum = $this->faker->unique()->randomNumber();
        $title = $this->faker->text($maxNbChars = 30);
        $sensitive_chance = config('seeder.posts.sensitive');
        $status_chance = config('seeder.posts.status');
        $postTypeOptions = config('platform.database.posts.types.options');
        $postTypeRandom = array_rand($postTypeOptions);
        $postThemeOptions = config('platform.database.posts.themes.options');
        $postThemeRandom = array_rand($postThemeOptions);
        $sourceOptions = config('seeder.posts.sources.options');
        $sourceRandom = array_rand($sourceOptions);
        $tagsCount = CuriousNum::getRandomBias(config('seeder.posts.tags'));
        $created_at = $this->faker->dateTimeBetween($startDate = '-36 months', $endDate = 'now');
        $posted_at = $this->faker->dateTimeBetween($created_at, $endDate = 'now');

        return [
            'user_id' => $rnum,
            'title' => $title,
            'notes' => $this->faker->text($maxNbChars = 280),
            'text' => Arr::random([$this->faker->text($maxNbChars = 280), null]),
            'text_alt' => Arr::random([$this->faker->text($maxNbChars = 280), null]),
            'sensitive' => $this->faker->boolean($chanceOfGettingTrue = $sensitive_chance),
            'lang'=> $this->faker->languageCode(),
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
    }
}
