<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExerciseRoutine extends Model
{
    protected $fillable = [
        'exercise_id',
        'routine_id',
        'sets',
        'reps',
        'rest_seconds',
        'instructions',
    ];

    public function exercise()
    {
        return $this->belongsTo(Exercise::class);
    }

    public function routine()
    {
        return $this->belongsTo(Routine::class);
    }
}
