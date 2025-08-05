<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
        'status',
    ];

    protected $casts = [
        'rating' => 'decimal:1',
        'birthdate' => 'date',
    ];

    public function classActivities(): HasMany
    {
        return $this->hasMany(ClassActivity::class);
    }
}
