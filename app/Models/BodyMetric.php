<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BodyMetric extends Model
{
    protected $fillable = [
        'member_id',
        'measured_at',
        'weight',
        'height',
        'bmi',
        'body_fat_percentage',
        'muscle_mass',
        'water_percentage',
        'chest_circumference',
        'waist_circumference',
        'hip_circumference',
        'arm_circumference',
        'leg_circumference',
    ];

    protected $casts = [
        'measured_at' => 'datetime',
        'weight' => 'decimal:2',
        'height' => 'decimal:2',
        'bmi' => 'decimal:2',
        'body_fat_percentage' => 'decimal:2',
        'muscle_mass' => 'decimal:2',
        'water_percentage' => 'decimal:2',
        'chest_circumference' => 'decimal:2',
        'waist_circumference' => 'decimal:2',
        'hip_circumference' => 'decimal:2',
        'arm_circumference' => 'decimal:2',
        'leg_circumference' => 'decimal:2',
    ];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function getBmiAttribute($value)
    {
        if ($value !== null) {
            return $value;
        }

        if ($this->weight !== null && $this->height !== null && $this->height > 0) {
            return round($this->weight / (($this->height / 100) ** 2), 2);
        }

        return null;
    }
}
