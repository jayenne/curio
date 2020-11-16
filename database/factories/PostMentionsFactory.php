<?php

namespace Database\Factories;

use App\PostMentions;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostMentionsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PostMentions::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'social_id' => $this->faker->randomNumber(),
            'handle' => $this->faker->userName(),
        ];
    }
}
