<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu_model extends Model
{
    protected $table = 'menu'; // put your table name here
    public $timestamps = true;
   /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
       'menu_id',
       'event_date',
       'menu',
       'other_menu',
       'category_id'
        
    ];
}
