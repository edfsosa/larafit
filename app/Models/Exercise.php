<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
    protected $fillable = [
        'name',
        'description',
        'difficulty',
        'type',
        'image',
        'video_url',
    ];

    public function routines()
    {
        return $this->belongsToMany(Routine::class, 'exercise_routines')
                    ->withPivot('sets', 'reps', 'rest_seconds', 'instructions')
                    ->withTimestamps();
    }
}
