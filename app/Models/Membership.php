<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Membership extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price',
        'duration_days',
    ];

    public function members()
    {
        return $this->belongsToMany(Member::class, 'member_memberships')
                    ->withPivot('start_date', 'end_date', 'status')
                    ->withTimestamps();
    }
}
