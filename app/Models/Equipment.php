<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Equipment extends Model
{
    protected $fillable = [
        'name',
        'description',
        'image_path',
        'video_url',
        'serial_number',
        'brand',
        'model',
        'type',
        'status',
        'purchased_at',
        'last_service_at',
        'next_service_due'
    ];

    protected $casts = [
        'purchased_at' => 'date',
        'last_service_at' => 'date',
        'next_service_due' => 'date'
    ];

    /**
     * Relación con los ejercicios, un equipamiento puede estar asociado a muchos ejercicios 
     */
    public function exercises(): HasMany
    {
        return $this->hasMany(Exercise::class);
    }
}
