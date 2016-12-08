<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Newsletter_model extends Model
{
    //
    protected $table = 'newsletter'; // put your table name here
    
    protected $primaryKey  = 'newsletter_id'; //primary key
    
    public $timestamps = true;
   /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
   protected $fillable = [
       'newsletter_id',
       '_token',
       'email',
       'subcription_date',
       'unsubcription_date'
   ];
}
