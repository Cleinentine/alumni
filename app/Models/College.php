<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class College extends Model
{
    protected $fillable = ['id', 'name'];

    public function program()
    {
        return $this->hasMany(Program::class);
    }
}
