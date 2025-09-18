<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoutineSet extends Model
{
    protected $fillable = [
        'routine_exercise_id',
        'sets',
        'reps',
        'weight',
        'duration',
        'distance',
        'rest_time',
    ];

    protected $casts = [
        'sets' => 'integer',
        'reps' => 'integer',
        'weight' => 'integer',
        'duration' => 'integer',
        'distance' => 'integer',
        'rest_time' => 'integer',
    ];

    public function routineExercise()
    {
        return $this->belongsTo(RoutineExercise::class);
    }
}
