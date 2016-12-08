<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quick_links_model extends Model
{
    //
   protected $table = 'quick_links'; // put your table name here
   public $timestamps = true;
   /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
   protected $fillable = [
       'quick_links_id',
       '_token',
       'link_url',
       'link_friendly',
       'link_sort',
       'active',
       'link_type'
       
   ];
}
