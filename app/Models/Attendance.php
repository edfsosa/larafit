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

    protected $casts = [
        'date' => 'date',
        'present' => 'boolean',
    ];

    public function attendable()
    {
        return $this->morphTo();
    }

    public function logs()
    {
        return $this->hasMany(AttendanceLog::class);
    }

    public function scopeforDate($query, $date)
    {
        return $query->where('date', $date);
    }

    public function scopePresent($query)
    {
        return $query->where('present', true);
    }

    public function scopeAbsent($query)
    {
        return $query->where('present', false);
    }

    public function getAttendeeNameAttribute()
    {
        return $this->attendable?->user?->name;
    }
}
