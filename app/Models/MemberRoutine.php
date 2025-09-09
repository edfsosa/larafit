<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MemberRoutine extends Model
{
    protected $fillable = [
        'member_id',
        'routine_id',
        'trainer_id',
        'assigned_at',
        'status',
        'notes',
    ];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function routine()
    {
        return $this->belongsTo(Routine::class);
    }

    public function trainer()
    {
        return $this->belongsTo(Trainer::class);
    }

    public function scopeNotStarted($query)
    {
        return $query->where('status', 'not_started');
    }

    public function scopeInProgress($query)
    {
        return $query->where('status', 'in_progress');
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    public function scopeAssignedTo($query, $memberId)
    {
        return $query->where('member_id', $memberId);
    }

    public function getTrainerNameAttribute()
    {
        return $this->trainer?->user?->name;
    }

    public function getRoutineNameAttribute()
    {
        return $this->routine?->name;
    }

    public function getMemberNameAttribute()
    {
        return $this->member?->user?->name;
    }
}
