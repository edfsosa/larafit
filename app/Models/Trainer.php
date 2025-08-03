<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Trainer extends Model
{
    protected $fillable = [
        'name',
        'specialty',
    ];

    public function classActivities(): HasMany
    {
        return $this->hasMany(ClassActivity::class);
    }
}
