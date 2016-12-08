<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu_category_model extends Model
{
    protected $table = 'menu_category'; // put your table name here
   public $timestamps = true;
   /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
   protected $fillable = [
       'category_id',
       'category_name',
       'category_sort',
   ];
}
