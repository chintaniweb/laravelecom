<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class widget_footer extends Model
{
    protected $table="widget_footer";
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
