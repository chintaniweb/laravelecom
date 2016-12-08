<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class HomepageBanners extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //create table
       Schema::create('homepage_banners', function (Blueprint $table) {
            $table->increments('banner_id');
            $table->string('_token');
            $table->string('title');
            $table->string('url');
            $table->string('image');
            $table->string('fix_size');            
            $table->datetime('start_date');                         
            $table->datetime('end_date');                         
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
        //drop table
        Schema::drop('homepage_banners');
    }
}
