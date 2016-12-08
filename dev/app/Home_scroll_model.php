<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Home_scroll_model extends Model
{
    //
   protected $table = 'home_scroll'; // put your table name here
   public $timestamps = true;
   /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
   protected $fillable = [
       'home_scroll_id',
       '_token',
       'headline',
       'link',
       'scroll_sort'
       
   ];
}
