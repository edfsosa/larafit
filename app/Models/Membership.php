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

    protected $casts = [
        'price' => 'decimal:2',
        'duration_days' => 'integer',
    ];

    public function members()
    {
        return $this->belongsToMany(Member::class, 'member_memberships')
            ->withPivot('start_date', 'end_date', 'status')
            ->withTimestamps();
    }

    public function memberMemberships()
    {
        return $this->hasMany(MemberMembership::class);
    }

    public function payments()
    {
        return $this->hasManyThrough(Payment::class, MemberMembership::class);
    }

    public function scopeActive($query)
    {
        return $query->whereHas('members', function ($q) {
            $q->wherePivot('status', 'active')
                ->wherePivot('end_date', '>=', now());
        });
    }

    public function getDurationInWeeksAttribute()
    {
        return round($this->duration_days / 7, 2);
    }

    public function getDurationInMonthsAttribute()
    {
        return round($this->duration_days / 30, 2);
    }
}
