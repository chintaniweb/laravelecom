<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alert_message_model extends Model
{
     protected $table = 'alert_message'; // put your table name here
   public $timestamps = true;
   /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
   protected $fillable = [
       'alert_message_id',
       '_token',
       'subject',
       'on_site_date',
       'off_site_date',
        'details',
       'alert_image',
       
       
   ];
}
