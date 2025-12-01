<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $fillable = [
        'id',
        'name',
        'iso3',
        'iso2',
        'phonecode',
        'capital',
        'currency',
        'currency_symbol',
        'tld',
        'native',
        'region',
        'subregion',
        'timezones',
        'translations',
        'latitude',
        'longitude',
        'emoji',
        'emojiU',
        'flag',
        'wikiDataId',
    ];

    public function cities()
    {
        return $this->hasMany(City::class);
    }

    public function employment()
    {
        return $this->hasOne(Employment::class);
    }

    public function states()
    {
        return $this->hasMany(State::class);
    }
}
