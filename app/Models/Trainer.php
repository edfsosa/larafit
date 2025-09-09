<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trainer extends Model
{
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

    public function attendances()
    {
        return $this->morphMany(Attendance::class, 'attendable');
    }

    public function routines()
    {
        return $this->belongsToMany(Routine::class, 'member_routines')
            ->withPivot('assigned_at', 'status', 'notes', 'member_id')
            ->withTimestamps();
    }

    public function memberRoutines()
    {
        return $this->hasMany(MemberRoutine::class);
    }
}
