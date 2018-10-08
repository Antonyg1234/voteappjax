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
            ['title'=>'GANESHA CREATIVITY!!! ', 'description'=>'The awakening of Lord Ganesha! 

A new dawn! A new beginning! 

Couldn’t be any better than starting our Employee Engagement activities with anything else but Lord Ganesha blessings.Create:   Any 1 form of art work to depict Lord Ganesha E.g: Painting, Idol, Rangoli etc. No limit on creativity. (Eco friendly art work will be more appreciated)

Team Formation:  Inter/Cross Department,  Members limit : Minimum 3 and Maximum 6

Material:  As per the requirement, each team brings in their own material.

Reward:  Shall be given to the winner and the 1st Runner up

Time limit: 2 hours

Date: Friday, 21st September 2018

Time: 3 PM to 5 PM (Please discuss with your coordinators)','image'=>''  ,'voting_end_date' => '2018-10-15 01:20:20','voting_start_date' => '2018-10-11 15:00:00','event_date' => '2018-09-17 15:00:00',
                'location'=>'Rabale Office, Ruby Office, Pune Office, Loarparel Office','created_at' => Carbon::now(),

            ],
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
