<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Block_ip_model extends Model
{
    protected $table = 'block_ip'; // put your table name here
   public $timestamps = true;
   
   protected $primaryKey  = 'block_id';
   /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
   protected $fillable = [
       'block_id',
       'ip_address'
   ];
}
