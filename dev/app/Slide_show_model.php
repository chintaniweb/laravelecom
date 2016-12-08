<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slide_show_model extends Model
{
    protected $table='slide_show'; //put your table name
    
    protected  $primaryKey='slide_show_id'; //primary key
   
    
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'slide_show_id',
        'website_id',
        '_token',
        'title',
        'transitions',
        'slide_show_category_id',
        'password',
        'slide_show_sort',
        'on_site_date',
        'off_site_date',
        'description'
    ];
}

