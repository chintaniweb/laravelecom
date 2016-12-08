<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usermodel extends Model
{
     protected $table = "permissions";
    
    protected $fillable= [
      'id',
        '_token',
        'permKey',
        'permName'
        
    ];
}
