<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttendanceRecord extends Model
{
    protected $fillable = [
        'attendable_type',
        'attendable_id',
        'checked_in_at',
        'checked_out_at',
        'method',
    ];

    protected $casts = [
        'checked_in_at' => 'datetime',
        'checked_out_at' => 'datetime',
    ];

    public function attendable()
    {
        return $this->morphTo();
    }
}
