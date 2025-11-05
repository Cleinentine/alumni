<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
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
}
