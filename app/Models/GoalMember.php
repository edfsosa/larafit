<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GoalMember extends Model
{
    protected $fillable = [
        'goal_id',
        'member_id',
        'assigned_at',
        'status',
    ];

    protected $casts = [
        'assigned_at' => 'date',
    ];

    public function goal()
    {
        return $this->belongsTo(Goal::class);
    }

    public function member()
    {
        return $this->belongsTo(Member::class);
    }
}
