<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SchoolBoardMembers extends Migration
{
   /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('school_board_members', function (Blueprint $table) {
            $table->increments('school_board_member_id');
            $table->string('_token');
            $table->string('name');
            $table->string('title');
            $table->string('address1');
            $table->string('address2');
            $table->string('address3');
            $table->string('email');
            $table->string('phone');
            $table->string('term_ends');
            $table->string('picture');
            $table->string('additional_info');
            $table->float('members_sort');
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
         Schema::drop('school_board_members');
    }
}
