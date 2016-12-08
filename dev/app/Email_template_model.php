<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Email_template_model extends Model {

    protected $table = 'email_template'; //put your table name
    protected $primaryKey = 'email_template_id'; //primary key

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email_template_id',
        '_token',
        'email_template_name',
        'from_name',
        'from_email',
        'subject',
        'body'
    ];

}
