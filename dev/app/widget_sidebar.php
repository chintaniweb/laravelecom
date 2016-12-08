<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class widget_sidebar extends Model
{
    protected $table="widget_sidebar";
    protected $fillable = [
      'id',
        '_token',
        'widget_id',
        'title',
        'content',
        'page_sort',
        'status'
        ];
}
