<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Filing_cabinet_model extends Model {

    //
    protected $table = 'filing_cabinet'; // put your table name here
    protected $primaryKey = 'filing_cabinet_id'; //primary key
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'filing_cabinet_id',
        '_token',
        'file_name',
        'filing_cabinet_category_id',
        'show_file_date',
        'hide_file_date',
        'file_description',
        'file_sort'
    ];

}
