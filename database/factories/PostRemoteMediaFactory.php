<?php

namespace Database\Factories;

use App\PostRemoteMedia;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostRemoteMediaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PostRemoteMedia::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'url' => $this->faker->imageUrl($width = 640, $height = 480), // 'http://lorempixel.com/640/480/'
            'title' => $this->faker->sentence($nbWords = 6, $variableNbWords = true),
            'alt' => $this->faker->sentence($nbWords = 4, $variableNbWords = true),
            'type' => 'other',
        ];
    }
}
