<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact_feedback_model extends Model
{
     protected $table = 'contact_feedback'; // put your table name here
     
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'contact_id',
        '_token',
        'name',
        'comment',
        'email',
        'phone',
        'location_id',
        'feedback_status',
        'respond_location_id',
        'respond_feedback',
        'forward_location_id',
        'forward_comment',
        'forward_email',
        'forward_email_subject'
        
    ];
}
