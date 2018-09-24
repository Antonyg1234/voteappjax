<?php

use Illuminate\Database\Seeder;

class EventParticipantsMemberTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Model\EventParticipantsMember::class, 100)->create();
    }
}
