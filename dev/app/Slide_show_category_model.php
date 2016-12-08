<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slide_show_category_model extends Model
{
     protected $table = 'slide_show_category'; // put your table name here
     
    protected $primaryKey  = 'slide_show_category_id'; //primary key
     
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'slide_show_category_id',
        '_token',
        'name',
        'category_sort',
        'location_id'
    ];
}
