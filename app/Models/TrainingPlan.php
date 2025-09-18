<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrainingPlan extends Model
{
    protected $fillable = [
        'name',
        'description',
        'difficulty',
        'is_template',
    ];

    protected $casts = [
        'is_template' => 'boolean',
    ];

    public function phases()
    {
        return $this->hasMany(PlanPhase::class);
    }
}
