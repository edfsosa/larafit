<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PlanItem extends Model
{
    protected $fillable = [
        'workout_plan_id',
        'exercise_id',
        'sets',
        'reps',
        'weight',
        'notes',
    ];

    protected $casts = [
        'sets'   => 'integer',
        'reps'   => 'integer',
        'weight' => 'decimal:2',
    ];

    /** Rutina a la que pertenece este ítem */
    public function workoutPlan(): BelongsTo
    {
        return $this->belongsTo(WorkoutPlan::class);
    }

    /** Ejercicio asociado al ítem */
    public function exercise(): BelongsTo
    {
        return $this->belongsTo(Exercise::class);
    }
}
