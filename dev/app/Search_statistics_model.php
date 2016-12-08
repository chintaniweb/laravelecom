<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Search_statistics_model extends Model
{
   protected $table = 'site_search'; // put your table name here
     
     protected $primaryKey  = 'site_search_id';
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'site_search_id',
        '_token',
        'search_for',
        'details',
        
    ];
}
