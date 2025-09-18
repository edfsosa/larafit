<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlanDay extends Model
{
    protected $fillable = [
        'plan_week_id',
        'day',
    ];

    public function week()
    {
        return $this->belongsTo(PlanWeek::class);
    }

    public function routines()
    {
        return $this->belongsToMany(Routine::class, 'plan_day_routines')
            ->withPivot('order')
            ->withTimestamps()
            ->orderBy('pivot_order');
    }
}
