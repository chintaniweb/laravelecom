<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Redirect_model extends Model {

    protected $table = 'redirect'; //put your table name
    protected $primaryKey = 'redirect_id'; //primary key

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'redirect_id',
        '_token',
        'source_url',
        'target_url'
    ];

}
