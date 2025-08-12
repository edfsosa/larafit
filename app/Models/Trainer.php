<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Trainer extends Model
{
    protected $fillable = [
        'document_number',
        'name',
        'birthdate',
        'gender',
        'phone',
        'email',
        'photo_path',
        'bio',
        'specialty',
        'rating',
        'is_active',
    ];

    protected $casts = [
        'rating' => 'decimal:1',
        'birthdate' => 'date',
        'is_active' => 'boolean',
    ];

    public function classActivities(): HasMany
    {
        return $this->hasMany(ClassActivity::class);
    }

    public function workouts(): HasMany
    {
        return $this->hasMany(WorkoutPlan::class);
    }
}
