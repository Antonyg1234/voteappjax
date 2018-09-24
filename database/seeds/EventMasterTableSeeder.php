<?php

use Illuminate\Database\Seeder;

class EventMasterTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Model\EventMaster::class, 25)->create();
    }
}
