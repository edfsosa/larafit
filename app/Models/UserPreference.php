<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserPreference extends Model
{
    protected $fillable = [
        'user_id',
        'language',
        'theme',
        'email_notifications',
        'push_notifications',
        'unit_system',
        'show_tutorials',
        'show_calories',
        'show_equipment_tips',
        'extra_preferences',
    ];

    protected $casts = [
        'email_notifications' => 'boolean',
        'push_notifications' => 'boolean',
        'show_tutorials' => 'boolean',
        'show_calories' => 'boolean',
        'show_equipment_tips' => 'boolean',
        'extra_preferences' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
