<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExerciseCompletion extends Model
{
    protected $fillable = [
        'member_routine_id',
        'exercise_id',
        'completed',
        'completed_at',
    ];

    protected $casts = [
        'completed' => 'boolean',
        'completed_at' => 'datetime',
    ];

    /**
     * Relación con la rutina del miembro
     */
    public function memberRoutine()
    {
        return $this->belongsTo(MemberRoutine::class);
    }

    /**
     * Relación con el ejercicio
     */
    public function exercise()
    {
        return $this->belongsTo(Exercise::class);
    }
    
    /**
     * Alcance para filtrar ejercicios completados
     */
    public function scopeCompleted($query)
    {
        return $query->where('completed', true);
    }

    /**
     * Alcance para filtrar ejercicios no completados
     */
    public function scopeNotCompleted($query)
    {
        return $query->where('completed', false);
    }
}
