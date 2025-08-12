<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Member extends Model
{
    protected $fillable = [
        'document_number',
        'name',
        'birthdate',
        'gender',
        'photo_path',
        'phone',
        'email',
        'address',
        'city',
        'joined_at',
        'active',
        'emergency_contact_name',
        'emergency_contact_phone',
        'height_cm',
        'weight_kg',
        'rating',
    ];

    protected $casts = [
        'joined_at' => 'date',
        'active'    => 'boolean',
        'birthdate' => 'date',
        'height_cm' => 'integer',
        'weight_kg' => 'decimal:2',
        'rating'    => 'decimal:1',
    ];

    public function memberships(): HasMany
    {
        return $this->hasMany(Membership::class);
    }

    // Última membresía activa (por fecha de fin)
    public function activeMembership(): HasOne
    {
        return $this->hasOne(Membership::class)
            ->ofMany('end_date', 'max')
            ->where('is_active', true);
    }

    public function attendanceRecords(): HasMany
    {
        return $this->hasMany(AttendanceRecord::class);
    }

    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }
}
