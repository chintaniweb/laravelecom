<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slide_show_images_front_model extends Model
{
    protected $table='slide_show_images'; //put your table name
    
    protected $primaryKey='slide_show_images_id'; //primary key
    
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'slide_show_images_id',
        'slide_show_id',
        '_token',
        'image',
        'image_sort',
        'image_caption'
       
    ];
}
