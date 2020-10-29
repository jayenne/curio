<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

//use Illuminate\Support\Facades\Hash;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    $gender = $faker->randomElement(['male', 'female']);
    ;
    $firstname = $faker->firstName($gender);
    $lastname = $faker->lastName;
    $seperator = $faker->randomElement(['.', '-', '_','']);

    $username = $firstname.$seperator.$lastname;
    $tld = $faker->randomElement(['.com', '.org', '.net','.co.uk','.co','.gov']);
    ;
    $email = $username.'@example'.$tld;
    $created_days = rand(10, 365 * 6);
    $verified_days = rand(10, $created_days);
    $login_days = rand(1, $verified_days);
    $active_hours = rand(0, $login_days * 24);

    return [
        //'uuid' => $faker->unique()->uuid(),
        'username' => $username,
        'name' => $firstname.' '.$lastname,
        'first_name' => $firstname,
        'last_name' => $lastname,
        'email' => $email,
        'password' => "password",
        'remember_token' => Str::random(10),
        'activation_token' => Str::random(60),
        'active_at' => $faker->dateTimeBetween($startDate = '-'.$active_hours.' hours', $endDate = 'now', $timezone = null),
        'login_at' => $faker->dateTimeBetween($startDate = '-'.$login_days.' days', $endDate = '-'.$active_hours.' hours', $timezone = null),
        'email_verified_at' => $faker->dateTimeBetween($startDate = '-'.$verified_days.' days', $endDate = '-'.$login_days.' days', $timezone = null),
        'created_at' => $faker->dateTimeBetween($startDate = '-'.$created_days.' days', $endDate = '-'.$verified_days.' days', $timezone = null),
    ];
});
