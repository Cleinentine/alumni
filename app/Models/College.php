<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class College extends Model
{
    public $timestamps = false;

    protected $fillable = ['id', 'name'];

    public function programs()
    {
        return $this->hasMany(Program::class);
    }
}
