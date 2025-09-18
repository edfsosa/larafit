<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MemberPlan extends Model
{
    protected $fillable = [
        'member_id',
        'training_plan_id',
        'trainer_id',
        'assigned_at',
        'status',
        'notes',
    ];

    protected $casts = [
        'assigned_at' => 'date',
    ];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function plan()
    {
        return $this->belongsTo(TrainingPlan::class);
    }

    public function trainer()
    {
        return $this->belongsTo(Trainer::class);
    }

    public function reviews()
    {
        return $this->morphMany(Review::class, 'reviewable');
    }
}
