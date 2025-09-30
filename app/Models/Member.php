<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Member extends Model
{
    use Notifiable;

    protected $fillable = [
        'user_id',
        'joined_at',
        'emergency_contact_name',
        'emergency_contact_phone',
        'status',
    ];

    protected $casts = [
        'joined_at' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function memberships()
    {
        return $this->belongsToMany(Membership::class, 'member_memberships')
            ->withPivot('start_date', 'end_date', 'status')
            ->withTimestamps();
    }

    public function memberMemberships()
    {
        return $this->hasMany(MemberMembership::class);
    }

    public function activeMemberMembership()
    {
        return $this->memberMemberships()
            ->whereIn('status', ['active', 'pending'])
            ->with('membership', 'payments')
            ->latest('start_date')
            ->first();
    }

    public function historicalMemberMemberships()
    {
        return $this->memberMemberships()
            ->whereNotIn('status', ['active', 'pending'])
            ->with('membership', 'payments')
            ->orderByDesc('start_date')
            ->get();
    }


    // obtener membresía activa
    public function activeMembership()
    {
        return $this->memberships()
            ->wherePivot('status', 'active')
            ->withPivot('start_date', 'end_date')
            ->first();
    }

    // obtener historial de membresías
    public function membershipHistory()
    {
        return $this->memberships()
            ->wherePivot('status', '!=', 'active')
            ->withPivot('start_date', 'end_date', 'status')
            ->orderByPivot('start_date', 'desc')
            ->get();
    }

    // Relacion con entrenadores
    public function trainers()
    {
        return $this->belongsToMany(Trainer::class, 'member_trainers')
            ->withPivot('assigned_at')
            ->withTimestamps();
    }

    // Relacion con planes de entrenamiento
    public function plans()
    {
        return $this->belongsToMany(TrainingPlan::class, 'member_plans')
            ->withPivot('assigned_at', 'status', 'trainer_id', 'notes')
            ->withTimestamps();
    }

    // Relacion uno a muchos con member_plans
    public function assignedPlans()
    {
        return $this->hasMany(MemberPlan::class);
    }

    // Relacion con pagos a traves de member_memberships
    public function payments()
    {
        return $this->hasManyThrough(Payment::class, MemberMembership::class);
    }

    // Relacion polimorfica con registros de asistencia
    public function attendanceRecords()
    {
        return $this->morphMany(AttendanceRecord::class, 'attendable');
    }

    // Accesor para obtener el nombre completo del usuario asociado
    public function getFullNameAttribute()
    {
        return $this->user?->name;
    }

    // Accesor para obtener el número de documento del usuario asociado
    public function getDocumentNumberAttribute()
    {
        return $this->user?->document_number;
    }

    // Accesor para obtener el estado del miembro en formato legible
    public function getMemberStatusAttribute()
    {
        switch ($this->status) {
            case 'active':
                return 'Activo';
            case 'inactive':
                return 'Inactivo';
            case 'suspended':
                return 'Suspendido';
            default:
                return 'Desconocido';
        }
    }

    // Relacion con objetivos a traves de goal_members
    public function goals()
    {
        return $this->belongsToMany(Goal::class, 'goal_members')
            ->withPivot('assigned_at', 'status')
            ->withTimestamps();
    }

    // Relacion uno a uno con perfil de fitness
    public function fitnessProfile()
    {
        return $this->hasOne(FitnessProfile::class);
    }

    // Relacion polimorfica con notificaciones
    public function notifications()
    {
        return $this->morphMany(Notification::class, 'notifiable');
    }

    // Relacion polimorfica con reviews
    public function reviews()
    {
        return $this->morphMany(Review::class, 'author');
    }

    // Relacion uno a muchos con metricas corporales
    public function bodyMetrics()
    {
        return $this->hasMany(BodyMetric::class);
    }
}
