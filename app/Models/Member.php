<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
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

    public function trainers()
    {
        return $this->belongsToMany(Trainer::class, 'member_trainers')
            ->withPivot('assigned_at')
            ->withTimestamps();
    }

    public function payments()
    {
        return $this->hasManyThrough(Payment::class, MemberMembership::class);
    }

    public function attendances()
    {
        return $this->morphMany(Attendance::class, 'attendable');
    }

    public function routines()
    {
        return $this->belongsToMany(Routine::class, 'member_routines')
            ->withPivot('assigned_at', 'status', 'notes', 'trainer_id')
            ->withTimestamps();
    }

    public function routineAssignments()
    {
        return $this->hasMany(MemberRoutine::class)
            ->with('routine', 'trainer');
    }

    public function getFullNameAttribute()
    {
        return $this->user?->name;
    }

    public function goals()
    {
        return $this->belongsToMany(Goal::class, 'goal_members')
            ->withPivot('assigned_at', 'status')
            ->withTimestamps();
    }

    public function fitnessProfile()
    {
        return $this->hasOne(FitnessProfile::class);
    }
}
