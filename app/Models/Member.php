<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Member extends Model
{
    protected $fillable = [
        'user_id',
        'joined_at',
        'emergency_contact_name',
        'emergency_contact_phone',
        'height',
        'weight',
        'status',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function memberships(): BelongsToMany
    {
        return $this->belongsToMany(Membership::class, 'member_memberships')
            ->withPivot('start_date', 'end_date', 'status')
            ->withTimestamps();
    }

    public function trainers(): BelongsToMany
    {
        return $this->belongsToMany(Trainer::class, 'member_trainers')
            ->withPivot('assigned_at')
            ->withTimestamps();
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    public function attendances(): MorphMany
    {
        return $this->morphMany(Attendance::class, 'attendable');
    }

    public function routines(): BelongsToMany
    {
        return $this->belongsToMany(Routine::class, 'member_routines')
            ->withPivot('assigned_at', 'status', 'notes', 'trainer_id')
            ->withTimestamps();
    }

    public function memberRoutines(): HasMany
    {
        return $this->hasMany(MemberRoutine::class);
    }
}
