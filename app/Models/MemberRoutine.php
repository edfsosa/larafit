<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MemberRoutine extends Model
{
    protected $fillable = [
        'member_id',
        'routine_id',
        'assigned_by',
        'assigned_at',
        'estimated_time',
        'status',
    ];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function routine()
    {
        return $this->belongsTo(Routine::class);
    }

    public function assignedBy()
    {
        return $this->belongsTo(Trainer::class, 'assigned_by');
    }
}
