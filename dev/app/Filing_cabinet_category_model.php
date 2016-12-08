<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Filing_cabinet_category_model extends Model {

    //
    protected $table = 'filing_cabinet_category'; // put your table name here
    protected $primaryKey = 'filing_cabinet_category_id'; //primary key
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'filing_cabinet_category_id',
        '_token',
        'parent_id',
        'category_name',
        'category_sort'
    ];

}
