<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Site_content_images extends Model
{
     protected $table = 'site_content_images'; // put your table name here
     
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'site_content_images_id',
        '_token',
        'sitecontent_id',
        'site_images',
        'image_caption',
        'image_info',
        'url'
    ];
}
