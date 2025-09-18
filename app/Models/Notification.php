<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = [
        'notifiable_type',
        'notifiable_id',
        'title',
        'body',
        'type',
        'scheduled_at',
        'sent_at',
        'is_read',
    ];

    protected $casts = [
        'scheduled_at' => 'datetime',
        'sent_at' => 'datetime',
        'is_read' => 'boolean',
    ];

    public function notifiable()
    {
        return $this->morphTo();
    }
}
