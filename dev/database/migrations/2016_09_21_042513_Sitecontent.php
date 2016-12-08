<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Sitecontent extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       //create table
       Schema::create('site_content', function (Blueprint $table) {
            $table->increments('sitecontent_id');
            $table->string('_token');
            $table->integer('parent_id');
            $table->integer('website_id');
            $table->string('navigation_title');
            $table->string('page_title');
            $table->string('access_url');
            $table->string('sub_title');
            $table->binary('page_text');
            $table->integer('page_sort');
            $table->enum('content_type',['MainPage','Schools','Internal']);
            $table->enum('page_type',['Typical Page','Goto Page']);
            $table->enum('on_site',['Yes','No']);
            $table->enum('status',['Draft','Pending','Published']);
            $table->enum('visibility',['Public','Password protected','Private']);
            $table->string('password');
            $table->string('meta_title');
            $table->string('meta_description');
            $table->string('meta_keywords');
            $table->string('targeted_keyword');
            $table->string('added_by');
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
         Schema::drop('site_content');
    }
}
