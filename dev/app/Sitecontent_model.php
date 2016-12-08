<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sitecontent_model extends Model
{
     protected $table = 'site_content'; // put your table name here
     
     protected $primaryKey  = 'sitecontent_id';
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'sitecontent_id',
        '_token',
        'parent_id',
        'website_id',
        'navigation_title',
        'page_title',
        'access_url',
        'sub_title',
        'page_text',
        'page_sort',
        'page_type',
        'content_type',
        'status',
        'on_site',
        'visibility',
        'password',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'added_by',
        'targeted_keyword'
    ];
}
