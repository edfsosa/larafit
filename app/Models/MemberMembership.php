<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MemberMembership extends Model
{
    protected $fillable = [
        'member_id',
        'membership_id',
        'start_date',
        'end_date',
        'status',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    // Relación con miembros
    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    // Relación con membresías
    public function membership()
    {
        return $this->belongsTo(Membership::class);
    }

    // Relación con pagos
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    // Scope para membresías activas
    public function scopeActive($query)
    {
        return $query->where('status', 'active')
            ->where('end_date', '>=', now());
    }

    // Accesor para el nombre del miembro
    public function getMemberNameAttribute()
    {
        return $this->member?->user?->name;
    }

    // Accesor para el nombre de la membresía
    public function getMembershipNameAttribute()
    {
        return $this->membership?->name;
    }

    // Accesor para el estado en español
    public function getStatusAttribute()
    {
        switch ($this->attributes['status']) {
            case 'active':
                return 'Activo';
            case 'expired':
                return 'Expirado';
            case 'cancelled':
                return 'Cancelado';
            case 'pending':
                return 'Pendiente';
            case 'suspended':
                return 'Suspendido';
            default:
                return 'Unknown';
        }
    }

    // Accesor para calcular los días restantes
    public function getDaysLeftAttribute()
    {
        if ($this->status !== 'active') {
            return 0;
        }

        $endDate = $this->end_date;
        $today = now()->startOfDay();

        if ($endDate->isPast()) {
            return 0;
        }

        return $today->diffInDays($endDate);
    }

    // Accesor para fecha de inicio formateada
    public function getFormattedStartDateAttribute()
    {
        return $this->start_date ? $this->start_date->format('d/m/Y') : null;
    }

    // Accesor para fecha de fin formateada
    public function getFormattedEndDateAttribute()
    {
        return $this->end_date ? $this->end_date->format('d/m/Y') : null;
    }
}
