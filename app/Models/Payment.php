<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'member_membership_id',
        'amount',
        'date',
        'method',
        'notes',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    public function memberMembership()
    {
        return $this->belongsTo(MemberMembership::class);
    }

    public function getMemberNameAttribute()
    {
        return $this->memberMembership?->member?->user?->name;
    }

    public function getMembershipNameAttribute()
    {
        return $this->memberMembership?->membership?->name;
    }
}
