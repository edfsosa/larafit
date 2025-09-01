<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Routine extends Model
{
    protected $fillable = [
        'name',
        'description',
        'trainer_id',
    ];

    public function trainer()
    {
        return $this->belongsTo(Trainer::class);
    }

    public function exercises()
    {
        return $this->belongsToMany(Exercise::class, 'exercise_routines')
                    ->withPivot('sets', 'reps', 'rest_seconds', 'instructions')
                    ->withTimestamps();
    }

    public function members()
    {
        return $this->belongsToMany(Member::class, 'member_routines')
                    ->withPivot('assigned_at')
                    ->withTimestamps();
    }
}
