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
}
