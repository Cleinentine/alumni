<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employment extends Model
{
    protected $fillable = [
        'graduate_id',
        'industry_id',
        'status',
        'title',
        'company',
        'city',
        'state',
        'country',
        'time_to_first_job',
        'search_methods',
        'progression',
        'unemployment',
    ];
}
