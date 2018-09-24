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

$factory->define(App\Model\EventParticipant::class, function (Faker $faker) {
    return [
        'event_id' => rand(1,5),
        'team_name' => $faker->sentence($nbWords = 6, $variableNbWords = true),
        'title' => $faker->sentence($nbWords = 6, $variableNbWords = true),
        'description' => $faker->realText(180),
        'contact_person' => $faker->firstName(),
        'email' => $faker->email,
        'mobile' => rand(1111111111,mt_getrandmax()),
    ];
});
