<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Exercise extends Model
{
    protected $fillable = [
        'name',
        'description',
        'image_path',
        'video_url',
        'type',
        'difficulty',
        'equipment',
        'primary_muscle_group',
        'secondary_muscle_group',
        'default_sets',
        'default_reps',
        'default_rest_period',
        'is_active',
    ];

    protected $casts = [
        'default_sets' => 'integer',
        'default_reps' => 'integer',
        'default_rest_period' => 'integer',
        'is_active' => 'boolean',
    ];

    /**
     * Ítems de rutina que usan este ejercicio
     */
    public function planItems(): HasMany
    {
        return $this->hasMany(PlanItem::class);
    }
}
