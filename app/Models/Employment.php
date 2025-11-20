<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employment extends Model
{
    protected $primaryKey = 'graduate_id';

    protected $fillable = [
        'graduate_id',
        'industry_id',
        'country_id',
        'city_id',
        'state_id',
        'status',
        'title',
        'company',
        'city',
        'country',
        'time_to_first_job',
        'search_methods',
        'unemployment',
    ];

    public function graduate()
    {
        return $this->belongsTo(Graduate::class);
    }

    public function industry()
    {
        return $this->hasOne(Industry::class, 'id', 'industry_id');
    }
}
