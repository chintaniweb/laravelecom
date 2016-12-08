<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact_feedback_email_model extends Model
{
    protected $table = 'contact_feedback_additional'; // put your table name here
     
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'additional_id',
        '_token',
        'name',
        'email',
    ];
}
