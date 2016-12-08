<?php namespace App;

use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole

{
     //use EntrustUserTrait;
     protected $table = 'roles';
      public $timestamps = true;
      protected  $primaryKey='id'; //primary key
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','website_id','name','display_name','description'
    ];

}