<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Goal extends Model
{
    protected $fillable = [
        'title',
        'description',
    ];

    public function members()
    {
        return $this->belongsToMany(Member::class, 'goal_members')
            ->withPivot('assigned_at', 'status')
            ->withTimestamps();
    }
}
