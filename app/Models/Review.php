<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'member_routine_id',
        'reviewer_id',
        'reviewed_id',
        'rating',
        'comment',
    ];

    protected $casts = [
        'rating' => 'integer',
    ];

    public function memberRoutine()
    {
        return $this->belongsTo(MemberRoutine::class, 'member_routine_id');
    }

    public function reviewer()
    {
        return $this->belongsTo(User::class, 'reviewer_id');
    }

    public function reviewed()
    {
        return $this->belongsTo(User::class, 'reviewed_id');
    }

    public function getReviewerNameAttribute()
    {
        return $this->reviewer?->name;
    }

    public function getReviewedNameAttribute()
    {
        return $this->reviewed?->name;
    }

    public function scopeForRoutine($query, $routineId)
    {
        return $query->where('routine_id', $routineId);
    }

    public function scopeByReviewer($query, $userId)
    {
        return $query->where('reviewer_id', $userId);
    }
}
