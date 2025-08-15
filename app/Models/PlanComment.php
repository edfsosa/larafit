<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PlanComment extends Model
{
    protected $fillable = [
        'workout_plan_id',
        'author_id',
        'comment',
        'completed',
    ];

    protected $casts = [
        'completed' => 'boolean',
    ];

    /** Rutina a la que pertenece el comentario */
    public function workoutPlan(): BelongsTo
    {
        return $this->belongsTo(WorkoutPlan::class);
    }

    /** Autor del comentario (socio o entrenador) */
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }
}
