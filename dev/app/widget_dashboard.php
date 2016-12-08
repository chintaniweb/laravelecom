<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class widget_dashboard extends Model
{
  protected $table="widget_dashboard";
    protected $fillable = [
      'id',
        '_token',
       'widget_id'
        ];
}
