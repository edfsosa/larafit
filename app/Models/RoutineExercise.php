<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoutineExercise extends Model
{
    protected $fillable = [
        'routine_id',
        'exercise_id',
        'order',
    ];

    protected $casts = [
        'order' => 'integer',
    ];

    public function routine()
    {
        return $this->belongsTo(Routine::class);
    }

    public function exercise()
    {
        return $this->belongsTo(Exercise::class);
    }

    public function sets()
    {
        return $this->hasMany(RoutineSet::class);
    }
}
