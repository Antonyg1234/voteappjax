<?php

use Illuminate\Database\Seeder;

class EventParticipantsAssetTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Model\EventParticipantsAsset::class, 100)->create();
    }
}
