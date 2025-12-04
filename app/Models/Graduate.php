<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Graduate extends Model
{
    use Searchable;

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
        return $this->hasOne(Employment::class, 'graduate_id', 'id');
    }

    public function feedback()
    {
        return $this->hasOne(Feedback::class);
    }

    public function program()
    {
        return $this->hasOne(Program::class, 'id', 'program_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
