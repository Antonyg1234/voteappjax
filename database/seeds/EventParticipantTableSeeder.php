<?php

use Illuminate\Database\Seeder;

class EventParticipantTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Model\EventParticipant::class, 25)->create();
    }
}
