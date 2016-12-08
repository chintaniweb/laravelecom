<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Form_creator_model extends Model
{
    protected $table        = 'form_creator'; // put your table name here
    protected $primaryKey   = 'form_creator_id'; //primary key
    protected $fillable     = [
        'form_creator_id',
        '_token',
        'form_name',
        'form_type',
        'on_site_date',
        'off_site_date',
        'off_site_info',
        'form_password',
        'email',
        'form_limit',
        'top_form_info',
        'bottom_form_info',
        'after_form_info'
    ];
}
