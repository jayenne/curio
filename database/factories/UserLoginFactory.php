<?php


namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\User;
use App\UserLogin;

class UserLoginFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UserLogin::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'ip' => '127.0.0.0',
            'iso_code' => 'US',
            'country' => 'United States',
            'city' => 'New Haven',
            'state' => 'CT',
            'state_name' => 'Connecticut',
            'postal_code' => '06510',
            'lat' => '41.31',
            'lon' => '-72.92',
            'timezone' => 'America/New_York',
            'continent' => 'NA',
            'currency' => 'USD',
            'default' => 1,
            'cached' => false,
        ];
    }
}
