<?php



namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\UserSocial;

class UserSocialFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UserSocial::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $social_id = $this->faker->unique()->regexify('[A-Za-z0-9]{10}');

        $seed = $this->faker->numberBetween($min = 1, $max = 1080);
        $width = '150';
        $height = '150';
        $mods = ['greyscale', ''];
        $index = array_rand($mods);
        $mod = '?'.$mods[$index];
        $avatar = 'https://picsum.photos/id/'.$seed.'/'.$width.'/'.$height.$mod;

        return [
            //'user_id' => $this->faker->numberBetween($min = 1, $max = 50),
            'service' => 'twitter',
            'social_id' => $social_id,
            'token' => $this->faker->regexify('[A-Za-z0-9]{20}'),
            //'name' => $first_name.' '.$last_name,
            //'nickname' => $first_name.'_'.$social_id,
            'avatar' => $avatar,
        ];
    }
}
