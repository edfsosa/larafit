<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlanWeek extends Model
{
    protected $fillable = [
        'plan_phase_id',
        'number',
    ];

    public function phase()
    {
        return $this->belongsTo(PlanPhase::class);
    }

    public function days()
    {
        return $this->hasMany(PlanDay::class);
    }
}
