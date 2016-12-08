<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SiteContentFiles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       //create table
       Schema::create('site_content_files', function (Blueprint $table) {
            $table->increments('site_content_files_id');
            $table->string('_token');
            $table->integer('sitecontent_id');
            $table->string('file_name');
            $table->string('friendly_name');
            $table->string('file_description');
            $table->string('file_sort');
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
        Schema::drop('site_content_files');
    }
}
