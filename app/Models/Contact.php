<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
        'id',
        'contact_email',
        'contact_number',
        'alternate_contact_number',
    ];
}
