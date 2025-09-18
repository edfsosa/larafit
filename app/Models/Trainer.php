<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Trainer extends Model
{
    use Notifiable;

    protected $fillable = [
        'user_id',
        'specialty',
        'bio',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function members()
    {
        return $this->belongsToMany(Member::class, 'member_trainers')
            ->withPivot('assigned_at')
            ->withTimestamps();
    }

    public function attendanceRecords()
    {
        return $this->morphMany(AttendanceRecord::class, 'attendable');
    }

    public function assignedRoutines()
    {
        return $this->belongsToMany(Routine::class, 'member_routines')
            ->withPivot('assigned_at', 'status', 'notes', 'member_id')
            ->withTimestamps();
    }

    public function memberPlans()
    {
        return $this->hasMany(MemberPlan::class)->with('plan', 'member');
    }

    public function getFullNameAttribute()
    {
        return $this->user?->name;
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
