<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employment extends Model
{
    protected $primaryKey = 'graduate_id';

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

    public function graduate()
    {
        return $this->belongsTo(Graduate::class);
    }
}
