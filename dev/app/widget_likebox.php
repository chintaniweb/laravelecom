<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class widget_likebox extends Model
{
    protected $table="widget_like_box_setting";
    protected $fillable = [
        'id',
        '_token',
        'title',
        'page_url',
        'color_schema',
        'border_color',
        'width',
        'height',
        'show_faces',
        'show_stream',
        'header'
        ];
}
