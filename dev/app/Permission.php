<?php

namespace App;

use Zizaco\Entrust\EntrustPermission;

class Permission extends EntrustPermission
{
    protected $table = 'permissions';
    public $timestamps = true;
    protected  $primaryKey='id'; 
//    
    protected $fillable= [
      'id',
        '_token',
        'name',
        'display_name',
        'description',
        'website_id'
        
    ];
}
