<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Form_answer_model extends Model
{
    protected $table        = 'form_answer';    // put your table name here
    protected $primaryKey   = 'form_answer_id'; //primary key
    protected $fillable     = [
        'form_questions_id',
        '_token',
        'form_submit_id',
        'form_creator_id',
        'form_questions_id',
        'answer'
    ];
}
