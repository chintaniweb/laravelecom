<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu_setting_model extends Model
{
     protected $table = 'menu_setting'; // put your table name here
    public $timestamps = true;
   /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
       'menu_setting_id',
       'ical_option',
       'weekend_option',
       
    ];
}
