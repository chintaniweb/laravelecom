<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Filing_cabinet_intro_model extends Model {

    //
    protected $table = 'filing_cabinet_intro'; // put your table name here
    protected $primaryKey = 'filing_cabinet_intro_id'; //primary key
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'filing_cabinet_intro_id',
        '_token',
        'headline',
        'header_image',
        'filesystem_intro'
    ];

}
