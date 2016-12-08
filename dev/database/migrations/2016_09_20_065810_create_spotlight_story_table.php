<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpotlightStoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spotlight_story', function (Blueprint $table) {
            $table->increments('spotlight_story_id');
            $table->string('_token');
            $table->string('title');
            $table->string('description');
            $table->enum('active',['Yes','No']);
            $table->enum('Website',['BOCES','CTE']);
            $table->string('spotlight_sort');
            $table->string('story_image');
            $table->string('caption');
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
         Schema::drop('spotlight_story');
    }
}
