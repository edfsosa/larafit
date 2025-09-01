<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $fillable = [
        'attendable_id',
        'attendable_type',
        'date',
        'present'
    ];

    public function attendable()
    {
        return $this->morphTo();
    }

    public function logs()
    {
        return $this->hasMany(AttendanceLog::class);
    }
}
