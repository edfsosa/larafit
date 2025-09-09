<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Routine extends Model
{
    protected $fillable = [
        'name',
        'description',
        'difficulty',
        'duration_minutes',
        'is_active',
    ];

    public function exercises()
    {
        return $this->belongsToMany(Exercise::class, 'exercise_routines')
            ->withPivot('sets', 'reps', 'rest_seconds', 'duration_seconds', 'order', 'instructions')
            ->withTimestamps();
    }

    public function members()
    {
        return $this->belongsToMany(Member::class, 'member_routines')
            ->withPivot('assigned_at', 'status', 'notes', 'trainer_id')
            ->withTimestamps();
    }
}
