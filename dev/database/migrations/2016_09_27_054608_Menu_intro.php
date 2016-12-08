<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MenuIntro extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_intro', function (Blueprint $table) {
            $table->increments('menu_intro_id');
            $table->string('_token');
            $table->string('headline');
            $table->string('header_image');
            $table->binary('menu_intro');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::drop('menu_intro');
    }
}
