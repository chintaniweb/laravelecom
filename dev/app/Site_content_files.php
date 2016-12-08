<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Site_content_files extends Model
{
    protected $table = 'site_content_files'; // put your table name here
     
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'site_content_files_id',
        '_token',
        'sitecontent_id',
        'file_name',
        'friendly_name',
        'file_description',
        'file_sort'
    ];
}
