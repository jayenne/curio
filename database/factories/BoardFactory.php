<?php

namespace Database\Factories;

use App\Board;
use App\Helpers\CuriousPeople\CuriousNum;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class BoardFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Board::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $sensitive_chance = config('seeder.posts.sensitive');
        $title = $this->faker->sentence($nbWords = 3, $variableNbWords = true);
        $tagsCount = CuriousNum::getRandomBias(config('seeder.boards.hashtags'));
        $date = $this->faker->dateTimeBetween($startDate = '-36 months', $endDate = 'now');
        $layout = array_keys(config('platform.database.boards.layouts.options'));
        $columns = array_keys(config('platform.database.boards.columns.options'));
        $orderby = array_keys(config('platform.database.boards.orderby.options'));
        $direction = $this->faker->boolean(50);

        return [
            'title' => $title,
            'body' => $this->faker->text($maxNbChars = 280),
            'sensitive'=> $this->faker->boolean($sensitive_chance),
            'layout' => $this->faker->randomElement($layout),
            'columns' => strval($this->faker->randomElement($columns)),
            'orderby' => $this->faker->randomElement($orderby),
            'direction' => $direction,
            'created_at' => $date,
            'updated_at' => $date,
        ];
    }
}
