<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FitnessProfile extends Model
{
    protected $fillable = [
        'member_id',
        'height',
        'weight',
        'workout_location',
        'body_focus_areas',
        'experience_level',
        'weekly_workout_frequency',
        'available_equipment',
        'intensity_preference',
        'workout_duration',
        'preferred_workout_time',
    ];

    protected $casts = [
        'height' => 'decimal:2',
        'weight' => 'decimal:2',
        'body_focus_areas' => 'array',
        'available_equipment' => 'array',
        'weekly_workout_frequency' => 'integer',
    ];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }
}
