<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu_intro_model extends Model
{
    protected $table = 'menu_intro'; // put your table name here
    public $timestamps = true;
   /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
       'menu_intro_id',
       '_token',
       'headline',
       'header_image',
       'menu_intro',
    ];
}
