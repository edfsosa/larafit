<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MemberPlan extends Model
{
    protected $fillable = [
        'member_id',
        'training_plan_id',
        'trainer_id',
        'assigned_at',
        'status',
        'notes',
    ];

    protected $casts = [
        'assigned_at' => 'date',
    ];

    // Relación con miembros
    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id');
    }

    // Relación con planes de entrenamiento
    public function plan()
    {
        return $this->belongsTo(TrainingPlan::class, 'training_plan_id');
    }

    // Relación con entrenadores
    public function trainer()
    {
        return $this->belongsTo(Trainer::class, 'trainer_id');
    }

    // Relación con reseñas (polimórfica)
    public function reviews()
    {
        return $this->morphMany(Review::class, 'reviewable');
    }

    // Accesor para el nombre del plan
    public function getPlanNameAttribute()
    {
        return $this->plan?->name;
    }

    // Accesor para la descripción del plan
    public function getPlanDescriptionAttribute()
    {
        return $this->plan?->description;
    }

    // Accesor para el nombre del entrenador
    public function getTrainerNameAttribute()
    {
        return $this->trainer?->user?->name;
    }

    // Accesor para el nombre del miembro
    public function getMemberNameAttribute()
    {
        return $this->member?->user?->name;
    }

    // Accesor para la fecha asignada en formato d/m/Y
    public function getAssignedAtFormattedAttribute()
    {
        return $this->assigned_at ? $this->assigned_at->format('d/m/Y') : null;
    }

    // Accesor para el estado en español
    public function getStatusAttribute()
    {
        switch ($this->attributes['status']) {
            case 'not_started':
                return 'No iniciado';
            case 'in_progress':
                return 'En progreso';
            case 'completed':
                return 'Completado';
            default:
                return 'Desconocido';
        }
    }
}
