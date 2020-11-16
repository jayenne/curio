<?php

namespace Database\Factories;

use App\PostUrls;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostUrlsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PostUrls::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'url' => $this->faker->url,
            'site' => '',
            'title' => '',
            'body' => '',
            'image' => '',
            'alt' => '',
            'locale' => '',
            'type' => '',
            'opengraph' => '',
        ];
    }
}
