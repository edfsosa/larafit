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
}
