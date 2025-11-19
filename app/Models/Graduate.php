<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Graduate extends Model
{
    protected $fillable = [
        'id',
        'user_id',
        'program_id',
        'country_id',
        'city_id',
        'state_id',
        'first_name',
        'middle_name',
        'last_name',
        'birth_date',
        'gender',
        'year_graduated',
    ];

    public function employment()
    {
        return $this->hasOne(Employment::class);
    }

    public function feedback()
    {
        return $this->hasOne(Feedback::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
