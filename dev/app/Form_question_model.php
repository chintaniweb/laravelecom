<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Form_question_model extends Model
{
    protected $table        = 'form_questions'; // put your table name here
    protected $primaryKey   = 'form_questions_id'; //primary key
    protected $fillable     = [
        'form_questions_id',
        '_token',
        'form_creator_id',
        'question',
        'question_require',
        'answer_type',
        'question_sort',
        'question_file',
        'questionphrase',
        'multiplechoicetext',
        'limit'
    ];
}
