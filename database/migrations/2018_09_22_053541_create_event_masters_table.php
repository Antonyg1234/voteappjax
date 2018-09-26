<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventMastersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_masters', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title',250);
            $table->text('description');
            $table->string('image');
            $table->dateTime('voting_end_date');
            $table->dateTime('event_date');
            $table->text('location');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('event_masters');
    }
}
