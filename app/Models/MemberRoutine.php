<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MemberRoutine extends Model
{
    protected $fillable = [
        'member_id',
        'routine_id',
        'trainer_id',
        'assigned_at',
        'status',
        'notes',
    ];

    protected $casts = [
        'assigned_at' => 'date',
    ];

    /**
     * Relación con el miembro al que se le asignó la rutina
     */
    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    /**
     * Relación con la rutina asignada
     */
    public function routine()
    {
        return $this->belongsTo(Routine::class);
    }

    /**
     * Relación con el entrenador que asignó la rutina
     */
    public function trainer()
    {
        return $this->belongsTo(Trainer::class);
    }

    /**
     * Alcance para filtrar rutinas no iniciadas
     */
    public function scopeNotStarted($query)
    {
        return $query->where('status', 'not_started');
    }

    /**
     * Alcance para filtrar rutinas en progreso
     */
    public function scopeInProgress($query)
    {
        return $query->where('status', 'in_progress');
    }

    /**
     * Alcance para filtrar rutinas completadas
     */
    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    /**
     * Alcance para filtrar rutinas asignadas a un miembro específico
     */
    public function scopeAssignedTo($query, $memberId)
    {
        return $query->where('member_id', $memberId);
    }

    /**
     * Obtener el nombre del entrenador asociado a esta rutina de miembro
     */
    public function getTrainerNameAttribute()
    {
        return $this->trainer?->user?->name;
    }

    /**
     * Obtener el nombre de la rutina asociada a esta rutina de miembro
     */
    public function getRoutineNameAttribute()
    {
        return $this->routine?->name;
    }

    /**
     * Obtener el nombre del miembro asociado a esta rutina de miembro
     */
    public function getMemberNameAttribute()
    {
        return $this->member?->user?->name;
    }

    /**
     * Relación con los ejercicios completados para esta rutina de miembro
     */
    public function exerciseCompletions()
    {
        return $this->hasMany(ExerciseCompletion::class);
    }

    /**
     * Obtener los ejercicios completados para la rutina de este miembro
     */
    public function completedExercises()
    {
        return $this->exerciseCompletions()->where('completed', true);
    }

    /**
     * Obtener los ejercicios pendientes (no completados) para la rutina de este miembro
     */
    public function pendingExercises()
    {
        return $this->exerciseCompletions()->where('completed', false);
    }

    /**
     * Verificar si un ejercicio específico ha sido completado para la rutina de este miembro
     */
    public function isExerciseCompleted($exerciseId)
    {
        return $this->exerciseCompletions()
            ->where('exercise_id', $exerciseId)
            ->where('completed', true)
            ->exists();
    }

    /**
     * Marcar un ejercicio como completado para la rutina de este miembro
     */
    public function markExerciseCompleted($exerciseId)
    {
        return $this->exerciseCompletions()->updateOrCreate(
            ['exercise_id' => $exerciseId],
            ['completed' => true, 'completed_at' => now()]
        );
    }
}
