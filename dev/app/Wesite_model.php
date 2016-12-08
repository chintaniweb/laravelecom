<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wesite_model extends Model {

    protected $table = 'website'; //put your table name
    protected $primaryKey = 'website_id'; //primary key

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'website_id',
        '_token',
        'name',
        'discription',
        'status',
        'website_logo'
    ];

}
