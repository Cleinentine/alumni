<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    public $timestamps = false;

    public $incrementing = false;

    protected $primaryKey = 'graduate_id';

    protected $keyType = 'int';

    protected $fillable = [
        'graduate_id',
        'relevance',
        'skills',
        'competency',
        'post_graduate',
        'engagement',
        'entrepreneurship',
        'suggestions',
        'date_submitted',
    ];

    public function getRouteKeyName()
    {
        return 'graduate_id';
    }

    public function graduate()
    {
        return $this->belongsTo(Graduate::class);
    }
}
