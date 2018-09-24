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

$factory->define(App\Model\EventParticipantsAsset::class, function (Faker $faker) {
    //$asset_type = array("image", "video");
    return [
        'event_p_id' => rand(1,25),
        'assets' => 'ganesha.jpg',
        'asset_type' => 'image',
    ];
});
