<?php

namespace Database\Factories;

use App\Helpers\CuriousPeople\CuriousNum;
use App\UserProfile;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserProfileFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UserProfile::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $sex = CuriousNum::getClosestElementByValue(
        config('seeder.users.sex'),
        rand(0, 100)
    );

        $gender = CuriousNum::getClosestElementByValue(
        config('seeder.users.gender'),
        rand(1, 1000) / 10
    );

        return [
            'sex' => $sex,
            'gender' => $gender,
            'location' => Str::limit($this->faker->address(), 29, $end = '…'),
            'title' => Str::limit($this->faker->paragraph($nbSentences = 1, $variableNbSentences = false), 49, $end = '…'),
            'body' => Str::limit($this->faker->paragraph($nbSentences = 4, $variableNbSentences = true), 159, $end = '…'),
        ];
    }
}
