<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    protected $table = 'equipment';

    protected $fillable = [
        'name',
        'description',
        'type',
        'image',
        'video_url',
        'serial_number',
        'brand',
        'model',
        'status',
        'purchased_at',
        'purchase_price',
    ];

    public function maintenances()
    {
        return $this->hasMany(EquipmentMaintenance::class, 'equipment_id');
    }
}
