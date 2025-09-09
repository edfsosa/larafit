<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExerciseRoutine extends Model
{
    protected $fillable = [
        'exercise_id',
        'routine_id',
        'equipment_id',
        'sets',
        'reps',
        'rest_seconds',
        'duration_seconds',
        'order',
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

    public function equipment()
    {
        return $this->belongsTo(Equipment::class);
    }
}
