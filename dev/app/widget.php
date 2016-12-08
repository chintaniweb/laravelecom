<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class widget extends Model
{
    protected $table="widget";
    protected $fillable = [
      'widgetid',
        '_token',
       'name',
        'title',
        'option',
        'status'
        ];
}
