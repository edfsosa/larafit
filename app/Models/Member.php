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

    public function trainers()
    {
        return $this->belongsToMany(Trainer::class, 'member_trainers')
            ->withPivot('assigned_at')
            ->withTimestamps();
    }

    public function plans()
    {
        return $this->belongsToMany(TrainingPlan::class, 'member_plans')
            ->withPivot('assigned_at', 'status', 'trainer_id', 'notes')
            ->withTimestamps();
    }

    public function payments()
    {
        return $this->hasManyThrough(Payment::class, MemberMembership::class);
    }

    public function attendanceRecords()
    {
        return $this->morphMany(AttendanceRecord::class, 'attendable');
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

    public function notifications()
    {
        return $this->morphMany(Notification::class, 'notifiable');
    }

    public function reviews()
    {
        return $this->morphMany(Review::class, 'author');
    }
}
