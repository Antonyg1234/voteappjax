<?php

use Faker\Generator as Faker;

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

$factory->define(App\Model\EventParticipantsMember::class, function (Faker $faker) {
    return [
        'event_id' => rand(1,5),
        'event_p_id' => rand(1,25),
        'name' => $faker->firstName(),
        'email' => $faker->email,
        'mobile' => rand(1111111111,mt_getrandmax()),
    ];
});
