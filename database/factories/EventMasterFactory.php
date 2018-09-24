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

$factory->define(App\Model\EventMaster::class, function (Faker $faker) {
    return [
        'title' => $faker->name,
        'description' => $faker->realText(180),
        'image' => 'ganpati.jpg',
        'event_date' => $faker->dateTimeBetween($startDate = 'now', $endDate = '+1 years'), // secret
        'location' => $faker->realText(180),
    ];
});
