<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Site_content_links extends Model
{
     protected $table = 'site_content_links'; // put your table name here
     
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'site_content_links_id',
        '_token',
        'sitecontent_id',
        'website_url',
        'friendly_url',
        'website_description',
        'link_sort'
    ];
}
