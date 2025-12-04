<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Industry extends Model
{
    public $timestamps = false;

    protected $fillable = ['id', 'name'];

    public function employment()
    {
        return $this->hasOne(Employment::class);
    }
}
