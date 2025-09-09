<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EquipmentMaintenance extends Model
{
    protected $table = 'equipment_maintenances';

    protected $fillable = [
        'equipment_id',
        'date',
        'type',
        'description',
        'cost',
    ];

    protected $casts = [
        'date' => 'date',
        'cost' => 'decimal:2',
    ];

    public function equipment()
    {
        return $this->belongsTo(Equipment::class);
    }

    public function scopePreventive($query)
    {
        return $query->where('type', 'preventive');
    }

    public function scopeRepair($query)
    {
        return $query->where('type', 'repair');
    }

    public function scopeInspection($query)
    {
        return $query->where('type', 'inspection');
    }

    public function getEquipmentNameAttribute()
    {
        return $this->equipment?->name;
    }

}
