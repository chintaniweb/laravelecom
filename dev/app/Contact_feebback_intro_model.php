<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact_feebback_intro_model extends Model
{
    protected $table = 'contact_feedback_intro'; // put your table name here
     
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'contact_intro_id',
        '_token',
        'headline',
        'header_image',
        'contact_intro'
    ];
}
