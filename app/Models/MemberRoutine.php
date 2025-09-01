<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MemberRoutine extends Model
{
    protected $fillable = [
        'member_id',
        'routine_id',
        'assigned_at',
    ];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function routine()
    {
        return $this->belongsTo(Routine::class);
    }
}
