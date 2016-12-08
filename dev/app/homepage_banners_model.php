<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class homepage_banners_model extends Model
{
    protected $table = 'homepage_banners'; // put your table name here
     
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'banner_id',
        '_token',
        'title',
        'url',
        'image',
        'fix_size',
        'start_date',
        'end_date'
    ];
}
