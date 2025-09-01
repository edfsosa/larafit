<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttendanceLog extends Model
{
    protected $fillable = [
        'attendance_id',
        'action',
        'recorded_at'
    ];

    public function attendance()
    {
        return $this->belongsTo(Attendance::class);
    }
}
