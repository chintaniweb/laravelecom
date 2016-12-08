<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feedback_email_model extends Model
{
      protected $table = 'location'; // put your table name here
      
      protected $primaryKey  = 'location_id'; //primary key
     
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'location_id',
        '_token',
        'location_name',
        'email',
    ];
}
