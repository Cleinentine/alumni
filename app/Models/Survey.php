<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    protected $fillable = [
        'id',
        'overall',
        'reason',
        'comment',
        'date_surveyed',
    ];
}
