<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactUs extends Model
{
    protected $fillable = ['contact_name', 'contact_email', 'contact_message', 'contact_subject', 'contact_type', 'view'];
    protected $table = 'contact_us';
}
