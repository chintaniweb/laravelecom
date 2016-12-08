<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SiteContentImages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //create table
       Schema::create('site_content_images', function (Blueprint $table) {
            $table->increments('site_content_images_id');
            $table->string('_token');
            $table->integer('sitecontent_id');
            $table->string('site_images');
            $table->string('image_caption');
            $table->string('image_info');
            $table->string('url');
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
        Schema::drop('site_content_images');
    }
}
