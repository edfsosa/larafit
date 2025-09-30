<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Membership extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price',
        'duration_days',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'duration_days' => 'integer',
    ];

    // Relación con miembros a través de member_memberships
    public function members()
    {
        return $this->belongsToMany(Member::class, 'member_memberships')
            ->withPivot('start_date', 'end_date', 'status')
            ->withTimestamps();
    }

    // Relación directa con member_memberships
    public function memberMemberships()
    {
        return $this->hasMany(MemberMembership::class);
    }

    // Relación con pagos a través de member_memberships
    public function payments()
    {
        return $this->hasManyThrough(Payment::class, MemberMembership::class);
    }

    // Scope para membresías activas
    public function scopeActive($query)
    {
        return $query->whereHas('members', function ($q) {
            $q->wherePivot('status', 'active')
                ->wherePivot('end_date', '>=', now());
        });
    }

    // Accesor para duración en semanas y meses
    public function getDurationInWeeksAttribute()
    {
        return round($this->duration_days / 7, 2);
    }

    // Accesor para duración en meses
    public function getDurationInMonthsAttribute()
    {
        return round($this->duration_days / 30);
    }

    // Accesor para precio formateado en guaranies paraguayos
    public function getFormattedPriceAttribute()
    {
        return 'Gs. ' . number_format($this->price, 0, ',', '.');
    }
}
