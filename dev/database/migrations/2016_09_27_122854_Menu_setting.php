<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MenuSetting extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_setting', function (Blueprint $table) {
            $table->increments('menu_setting_id');
            $table->string('_token');
            $table->enum('ical_option', ['Yes', 'No']);
            $table->enum('weekend_option', ['Show_weekend', 'No_weekend']);
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::drop('menu_setting');
    }
}
