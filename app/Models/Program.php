<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    public $timestamps = false;

    protected $fillable = ['id', 'college_id', 'name'];

    public function college()
    {
        return $this->belongsTo(College::class);
    }

    public function graduate()
    {
        return $this->belongsTo(Graduate::class);
    }
}
