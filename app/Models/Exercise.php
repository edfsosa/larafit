<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
    protected $fillable = [
        'name',
        'description',
        'type',
        'muscle_group',
        'image',
        'video_url',
        'equipment_id',
    ];

    public function equipment()
    {
        return $this->belongsTo(Equipment::class);
    }

    public function routines()
    {
        return $this->belongsToMany(Routine::class, 'routine_exercises')
            ->withPivot('order')
            ->withTimestamps()
            ->orderBy('pivot_order');
    }
}
