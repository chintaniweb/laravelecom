<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Job extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job',function ($table) {
            $table->increments('job_id');
            $table->integer('job_category_id');
            $table->integer('location_id');
            $table->string('title');
            $table->enum('site',['On','Off']);
            $table->enum('job_post',['Public','Internal']);
            $table->string('job_number');
            $table->string('salary');
            $table->date('job_appear');
            $table->date('job_disappear');
            $table->date('deadline');
            $table->date('start_date');
            $table->string('description');
            $table->string('job_qualification');
            $table->string('job_procedure');
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
        Schema::drop('job');
    }
}
