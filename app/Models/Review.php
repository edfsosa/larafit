<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'author_type',
        'author_id',
        'reviewable_type',
        'reviewable_id',
        'rating',
        'comment',
    ];

    protected $casts = [
        'rating' => 'integer',
    ];

    public function author()
    {
        return $this->morphTo();
    }

    public function reviewable()
    {
        return $this->morphTo();
    }
}
