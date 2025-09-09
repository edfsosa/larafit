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

    protected $casts = [
        'recorded_at' => 'datetime',
    ];

    public function attendance()
    {
        return $this->belongsTo(Attendance::class);
    }

    public function scopeCheckIns($query)
    {
        return $query->where('action', 'check_in');
    }

    public function scopeCheckOuts($query)
    {
        return $query->where('action', 'check_out');
    }
}
