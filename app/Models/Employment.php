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
        'time_to_first_job',
        'search_methods',
        'unemployment',
    ];

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function graduate()
    {
        return $this->belongsTo(Graduate::class);
    }

    public function industry()
    {
        return $this->hasOne(Industry::class, 'id', 'industry_id');
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }
}
