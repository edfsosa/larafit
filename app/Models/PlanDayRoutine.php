<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlanDayRoutine extends Model
{
    protected $fillable = [
        'plan_day_id',
        'routine_id',
        'order',
    ];

    public function day()
    {
        return $this->belongsTo(PlanDay::class);
    }

    public function routine()
    {
        return $this->belongsTo(Routine::class);
    }
}
