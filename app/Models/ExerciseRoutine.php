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

    protected $casts = [
        'sets' => 'integer',
        'reps' => 'integer',
        'rest_seconds' => 'integer',
        'duration_seconds' => 'integer',
        'order' => 'integer',
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

    public function getExerciseNameAttribute()
    {
        return $this->exercise?->name;
    }

    public function getRoutineNameAttribute()
    {
        return $this->routine?->name;
    }

    public function getEquipmentNameAttribute()
    {
        return $this->equipment?->name;
    }
}
