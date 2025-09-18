<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlanPhase extends Model
{
    protected $fillable = [
        'training_plan_id',
        'name',
        'description',
        'order',
    ];

    protected $casts = [
        'order' => 'integer',
    ];

    public function plan()
    {
        return $this->belongsTo(TrainingPlan::class);
    }

    public function weeks()
    {
        return $this->hasMany(PlanWeek::class);
    }
}
