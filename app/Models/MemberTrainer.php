<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MemberTrainer extends Model
{
    protected $fillable = [
        'member_id',
        'trainer_id',
        'assigned_at'
    ];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function trainer()
    {
        return $this->belongsTo(Trainer::class);
    }

    public function getMemberNameAttribute()
    {
        return $this->member?->user?->name;
    }

    public function getTrainerNameAttribute()
    {
        return $this->trainer?->user?->name;
    }
}
