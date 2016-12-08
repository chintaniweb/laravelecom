<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Calendarcategory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calendar_category', function (Blueprint $table) {
            $table->increments('calendar_category_id');
            $table->integer('website_id');
            $table->string('category_name');
            $table->float('category_sort');
            $table->enum('display',['Regular','Internal']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::drop('calendar_category');
    }
}
