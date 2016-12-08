<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Location extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('location', function (Blueprint $table) {
            $table->increments('location_id');
            $table->string('_token');
            $table->string('location_name');
            $table->integer('location_sort');
            $table->enum('school', ['Yes', 'No']);
            $table->enum('news', ['Yes', 'No']);
            $table->enum('staff', ['Yes', 'No']);
            $table->enum('calendar', ['Yes', 'No']);
            $table->enum('contact', ['Yes', 'No']);
            $table->string('address_line_1');
            $table->string('address_line_2');
            $table->string('address_line_3');
            $table->string('principal');
            $table->string('phone');
            $table->string('fax');
            $table->string('email');
            $table->string('location_photo');
            $table->string('map_1');
            $table->string('map_2');
            $table->text('map_direction');
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
         Schema::drop('location');
    }
}
