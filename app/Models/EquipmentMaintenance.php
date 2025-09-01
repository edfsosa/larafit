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

    public function equipment()
    {
        return $this->belongsTo(Equipment::class);
    }
}
