<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SchoolBoardIntro extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('school_board_intro', function (Blueprint $table) {
            $table->increments('school_board_intro_id');
            $table->string('_token');
            $table->string('headline');
            $table->string('header_image');
            $table->binary('board_member_intro');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::drop('school_board_intro');
    }
}
