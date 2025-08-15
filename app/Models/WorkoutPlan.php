<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class WorkoutPlan extends Model
{
    protected $fillable = [
        'member_id',
        'trainer_id',
        'title',
        'description',
        'status',
        'is_template',
        'starts_at',
        'ends_at',
        'repeat_pattern',
        'created_by',
        'updated_by',
        'notes',
    ];

    protected $casts = [
        'is_template' => 'boolean',
        'starts_at' => 'date',
        'ends_at' => 'date',
    ];

    /** Socio al que pertenece la rutina */
    public function member(): BelongsTo
    {
        return $this->belongsTo(Member::class);
    }

    /** Entrenador que creó o asignó la rutina */
    public function trainer(): BelongsTo
    {
        return $this->belongsTo(Trainer::class);
    }

    /** Ítems (ejercicios) de esta rutina */
    public function items(): HasMany
    {
        return $this->hasMany(PlanItem::class);
    }

    /** Comentarios marcados o no en la rutina */
    public function comments(): HasMany
    {
        return $this->hasMany(PlanComment::class);
    }

    /** Usuario que creó la rutina */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /** Usuario que la actualizó por última vez */
    public function updater(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
