<?php

use Illuminate\Database\Seeder;
use App\Model\EventMaster;
use Carbon\Carbon;

class EventMastersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Eloquent::unguard();

        //disable foreign key check for this connection before running seeders
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        EventMaster::truncate();
        $eventMasterData = [
            ['title'=>'Navratri Festival', 'description'=>'Navaratri also spelled Navratri or Navarathri, is a nine nights (and ten days) Hindu festival, ..... In North India, Navaratri is marked by the numerous Ramlila events.','image'=>''  ,'voting_end_date' => '2018-10-15 01:20:20','voting_start_date' => '2018-10-11 01:20:20','event_date' => '2018-10-10 01:20:20',
                'location'=>'Rabale Office, Ruby Office, Pune Office, Loarparel Office','created_at' => Carbon::now(),

            ],
            ['title'=>'Diwali Festival ', 'description'=>'Diwali also spelled Navratri or Navarathri, is a nine nights (and ten days) Hindu festival, In North India, Navaratri is marked by the numerous Ramlila events.','image'=>''  ,'voting_end_date' => '2018-11-10 01:20:20','voting_start_date' => '2018-10-11 01:20:20','event_date' => '2018-11-07 01:20:20',
                'location'=>'Rabale Office, Ruby Office, Pune Office, Loarparel Office','created_at' => Carbon::now(),

            ]
        ];


        DB::table("event_masters")->insert($eventMasterData);
    }
}
