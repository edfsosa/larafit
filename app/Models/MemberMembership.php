<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MemberMembership extends Model
{
    protected $fillable = [
        'member_id',
        'membership_id',
        'start_date',
        'end_date',
        'status',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];


    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function membership()
    {
        return $this->belongsTo(Membership::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active')
            ->where('end_date', '>=', now());
    }

    public function getMemberNameAttribute()
    {
        return $this->member?->user?->name;
    }

    public function getMembershipNameAttribute()
    {
        return $this->membership?->name;
    }
}
